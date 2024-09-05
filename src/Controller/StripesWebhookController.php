<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use Stripe;
use Stripe\Webhook;

class StripesWebhookController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Disable CSRF protection for the webhook endpoint
        Stripe\Stripe::setApiKey(STRIPE_SECRET);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Allow all actions
        $this->Authentication->allowUnauthenticated(['handleWebhook']);
        $this->Authorization->skipAuthorization();
    }

    public function handleWebhook()
    {
        // Existing code to verify webhook...
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = 'whsec_oQz8nJ7aA7T7kChT1fXGllPrLvqSHUgU';

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\Exception $e) {
            http_response_code(400);
            exit();
        }

        // Load Users model
        $this->loadModel('Users');

        // Handle the event
        switch ($event->type) {
            case 'invoice.payment_failed':
                $session = $event->data->object;
                $customerId = $session->customer;

                // Query your database to find the user associated with this Stripe customer ID
                $user = $this->Users->find()
                    ->where(['customer_id' => $customerId])
                    ->first();

                // If a user with the given customer_id exists
                if ($user) {
                    $user->active = 0;  // Set the 'active' field to false

                    if ($this->Users->save($user)) {
                        $this->log("User with customer_id $customerId has been marked as inactive.", 'info');
                    } else {
                        $this->log("Failed to update user with customer_id $customerId.", 'error');
                    }
                }
                break;

            case 'customer.subscription.deleted':
                $session = $event->data->object;
                $customerId = $session->customer;

                // Query your database to find the user associated with this Stripe customer ID
                $user = $this->Users->find()
                    ->where(['customer_id' => $customerId])
                    ->first();

                // If a user with the given customer_id exists
                if ($user) {
                    $user->active = 0;  // Set the 'active' field to false

                    if ($this->Users->save($user)) {
                        $this->log("User with customer_id $customerId has been marked as inactive.", 'info');
                    } else {
                        $this->log("Failed to update user with customer_id $customerId.", 'error');
                    }
                }
                break;

            // Add more cases for other event types if needed

            default:
                // Unexpected event type
                http_response_code(400);
                $response = $this->response->withStatus(400);  // Return a 400 failed status
                return $response;
                exit();
        }

        // Respond with a success status
        echo json_encode(['status' => 'success']);
        exit;
    }
}
