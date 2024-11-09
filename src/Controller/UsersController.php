<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Stripe;
use Stripe\Customer;
use Stripe\BillingPortal\Session as PortalSession;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;
use Stripe\Subscription;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use App\Model\Table\AuditsTable;
use App\Model\Table\LearnersTable;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\Log\Log;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public $Audits = null;
    public $Notifications = null;
    public $Learners = null;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Audits');
        $this->loadModel('Notifications');

        $this->configureStripe();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['login', 'register', 'verification', 'forgotpassword', 'resetpassword']);
        $this->Authorization->skipAuthorization(['index','login', 'register', 'verification', 'forgotpassword', 'resetpassword']);
    }

    protected function configureStripe(): void
    {
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);
    }
    public function index() {
        $user = $this->request->getAttribute('identity');

        // Authorization Check
        if (!$user->admin) {
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);
        }

        // Optimized way to get the count of learners for each user
        $users = $this->Users->find()
            ->contain(['Learners'])
            ->select([
                'Users.id',
                'Users.first_name',
                'Users.last_name',
                'Users.email',
                'Users.active',
                'Users.verified',
                'Users.admin',
                'Users.created',
                'numberOfLearners' => $this->Users->find()->func()->count('Learners.id')
            ])
            ->leftJoinWith('Learners')
            ->group(['Users.id'])
            ->toArray();

        $this->set(compact('users'));
    }
    public function view($id = null)
    {
        $this->loadModel('Audits');
        $this->loadModel('Learners');

        $user = $this->Users->get($id, ['contain' => ['Learners']]);
        $this->Authorization->authorize($user);

        $audits = $this->Audits->find()->where(['user_id' => $id])->all();
        $learners = $this->Learners->find()->where(['user_id' => $id])->all();

        $this->set(compact('user', 'audits', 'learners'));

        try {
            $stripeData = $this->retrieveStripeData($user->customer_id, $id);
            $this->set($stripeData);
        } catch (ApiErrorException $e) {
            $this->Flash->error(__('Error retrieving Stripe information: ') . $e->getMessage());
        }
    }

    protected function retrieveStripeData($stripeCustomerId, $userId)
    {
        // Retrieve a session for the customer portal and other related Stripe data.
        // Returns an array of data to be passed to the view.

        $stripePortal = PortalSession::create([
            'customer' => $stripeCustomerId,
            'return_url' => 'https://www.myhomelearner.com/users/view/' . $userId
        ]);

        $subscriptions = Subscription::all(['customer' => $stripeCustomerId]);
        $defaultPaymentMethod = null;

        if (count($subscriptions->data) > 0) {
            $defaultPaymentMethodId = $subscriptions->data[0]->default_payment_method;
            if ($defaultPaymentMethodId) {
                $defaultPaymentMethod = PaymentMethod::retrieve($defaultPaymentMethodId);
            }
        }

        return compact('stripePortal', 'subscriptions', 'defaultPaymentMethod');
    }
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('user'));
    }
    public function edit($id = null)
    {
        $user = $this->Users->get($id, ['contain' => []]);
        $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (empty($this->request->getData('password'))) {
                $this->request = $this->request->withData('password', null);
            }

            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                // Refresh user data in session
                if ($this->Authentication->getIdentity()->id === $user->id) {
                    $this->Authentication->setIdentity($user);
                }

                return $this->redirect(['action' => 'view', $user->id]);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('user'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        $this->Authorization->authorize($user);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        // If the result is valid and the user identity has been obtained
        if ($result && $result->isValid()) {
            $user = $this->Authentication->getIdentity();

            // Check if the user is verified
            if ($user->verified) {
                return $this->redirect($this->request->getQuery('redirect', [
                    'controller' => 'Users', // Usually after login, users are redirected to a dashboard or home page, not back to the Users index.
                    'action' => 'index',
                ]));
            } else {
                // User is not verified, log them out
                $this->Authentication->logout();

                // Send verification email
                $this->sendVerificationEmail($user);

                // Set flash message with link to resend verification email
                $this->Flash->error(__('Your account is not verified. Please check your email for the verification link.'), ['escape' => true]);
            }
        } elseif ($this->request->is('post')) {
            // Invalid login attempt
            $this->Flash->error(__('Invalid username or password'));
        }
    }
    public function logout()
    {
        $this->Authorization->skipAuthorization();

        if ($this->Authentication->getResult() && $this->Authentication->getResult()->isValid()) {
            $this->Authentication->logout();
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
    public function register()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->password = Security::randomString(6);
            $user->security_token = Security::randomString(48);

            if ($this->Users->save($user)) {
                $this->sendVerificationEmail($user);
                $this->Flash->success(__('Check your email for a verification link!'));
                $this->createWelcomeNotification($user);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('user'));
    }

    private function createWelcomeNotification($user)
    {
        $notification = $this->Notifications->newEmptyEntity();
        $notification->user_id = $user->id;
        $notification->subject = 'Welcome!';
        $notification->emailed = 1;
        $notification->importance = null;
        $notification->content = 'Welcome to MyHomeLearner!  Take some time to update your profile.';

        if (!$this->Notifications->save($notification)) {
            // Handle the error, e.g., log it.
            Log::error('Error creating notification for user ID: ' . $user->id);
        }
    }
    private function sendVerificationEmail($user)
    {
        $mailer = new Mailer('default');
        $mailer->viewBuilder()->setTemplate('registration');

        // Set email variables
        $mailer->setViewVars([
            'first_name' => $user->first_name,
            'token' => $user->security_token,
        ]);

        $fromEmail = Configure::read('Email.from', 'no-reply@myhomelearner.com');
        $mailer->setTransport('default')
            ->setFrom([$fromEmail => 'MyHomeLearner'])
            ->setTo($user->email)
            ->setEmailFormat('html')
            ->setSubject('Verify New Account');

        if (!$mailer->send()) {
            Log::error('Error sending verification email to ' . $user->email);
        }
    }
    public function verification($token)
    {
        $this->Authorization->skipAuthorization();
        $userTable = TableRegistry::get('Users');
        $user = $userTable->find('all')->where(['security_token' => $token])->first();

        if (!$user) {
            $this->Flash->error(__('Invalid or expired verification token.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $user->verified = '1';
        $user->active = '1';
        $user->security_token = Security::randomString(48);

        // Create a customer in Stripe and update the user
        $userTable->getConnection()->transactional(function () use ($user, $userTable) {
            $userTable->save($user);

            try {
                $stripeCustomer = Customer::create([
                    'email' => $user->email,
                    'name' => $user->first_name . ' ' . $user->last_name,
                ]);

                $user->customer_id = $stripeCustomer->id;
                $userTable->save($user);
                $this->Flash->success(__('Email verified. Please set your password.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'resetpassword', $user->security_token]);
            } catch (ApiErrorException $e) {
                Log::error('Stripe API Error: ' . $e->getMessage());
                $this->Flash->error(__('Failed to create a customer in Stripe.'));
                return $this->redirect(['action' => 'resetpassword', $user->security_token]);
            }
        });
    }
    public function forgotpassword()
    {
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            if (!$email) {
                $this->Flash->error(__('Please enter your email address'));
                return;  // End the function early
            }
            $token = Security::hash(Security::randomBytes(25));
            $userTable = TableRegistry::get('Users');
            $user = $userTable->find('all')->where(['email' => $email])->first();

            if ($user) {
                $user->security_token = $token;
                if ($userTable->save($user)) {
                    try {
                        $mailer = new Mailer('default');
                        $mailer->viewBuilder()->setTemplate('resetpassword');
                        // Set email variables
                        $mailer->setViewVars([
                            'first_name' => $user->first_name,
                            'token' => $user->security_token,
                        ]);
                        $mailer->setTransport('default'); //your email configuration name
                        $mailer->setFrom(['no-reply@myhomelearner.com' => 'MyHomeLearner'])
                            ->setTo($user->email)
                            ->setEmailFormat('html')
                            ->setSubject('Password Reset Request');
                        $mailer->send();
                    } catch (\Exception $e) {
                        // Log the error and rollback the changes
                        Log::error('Email sending failed: ' . $e->getMessage());
                        $userTable->getConnection()->rollback();
                    }
                }
            }

            $this->Flash->success('If the email was found, a link has been sent.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    public function resetpassword($token)
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->findBySecurityToken($token)->firstOrFail();

        // Potentially check for token expiry here...
        // ...

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // Clear the security token after usage
            $user->security_token = null;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been updated.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Unable to update your password.'));
            }
        }

        $this->set(compact('user'));

        // Ideally move this to model/table class
        $validator = new Validator();
        $validator
            ->requirePresence('password')
            ->notEmptyString('password')
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 8],
                    'message' => 'Password must be at least 8 characters long'
                ],
                'complexity' => [
                    'rule' => function ($value, $context) {
                        return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])/', $value);
                    },
                    'message' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character'
                ]
            ]);
        $errors = $validator->validate($this->request->getData());

        $this->set(compact('errors'));
    }
    public function subscribe($id = null)
    {
        // Assuming you have a method to get the logged-in user
        $loggedInUser = $this->getLoggedInUser();

        if (!$loggedInUser || $loggedInUser->id != $id) {
            $this->Flash->error(__('Unauthorized request.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Fetching user with a check
            $user = $this->Users->get($id);
            if (!$user) {
                $this->Flash->error(__('User not found.'));
                return $this->redirect(['action' => 'index']);
            }

            try {
                // Create payment method
                $paymentMethod = \Stripe\PaymentMethod::create([
                    'type' => 'card',
                    'card' => [
                        'number' => '4242424242424242',
                        'exp_month' => '05',
                        'exp_year' => '26',
                        'cvc' => '123',
                    ],
                ]);

                // Attach payment method to customer
                $paymentMethod->attach(['customer' => $user->customer_id]);

                // Determine the price based on the form value
                $subscriptionType = $data['subscriptionType'];
                $priceId = '';
                switch ($subscriptionType) {
                    case 'monthly':
                        $priceId = 'price_1NQh0B2HhyAahgTEEHMteiO3';
                        break;
                    case 'annually':
                        $priceId = 'price_1NQi6a2HhyAahgTEHU4sjVUW';
                        break;
                }

                // Create the subscription
                if ($priceId) {
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $user->customer_id,
                        'items' => [
                            ['price' => $priceId],
                        ],
                        'default_payment_method' => $paymentMethod->id,
                    ]);

                    // If the subscription is successful, set the user's active status to 1
                    $user->active = 1;
                    if (!$this->Users->save($user)) {
                        throw new \Exception("Failed to update user status.");
                    }

                    $this->Flash->success(__('Payment method added and subscription created successfully'));
                }
            } catch (\Exception $e) {
                $this->Flash->error(__('Error: ') . $e->getMessage());
                // Consider logging the error here...
            }

            return $this->redirect(['action' => 'index']);
        }
    }
    public function cancelSubscriptions($id = null)
    {
        // Get the user
        $user = $this->Users->get($id);

        // Validate user and customer ID
        if (!$user || !$user->customer_id) {
            $this->Flash->error(__('User or user Stripe customer ID not found.'));
            return $this->redirect(['action' => 'index']);
        }

        $notCancelled = []; // List of subscriptions that couldn't be canceled

        try {
            // Retrieve all active subscriptions for the customer
            $activeSubscriptions = \Stripe\Subscription::all([
                'customer' => $user->customer_id,
                'status' => 'active',
            ]);

            // Iterate through and attempt to cancel each active subscription
            foreach ($activeSubscriptions->data as $subscription) {
                $response = \Stripe\Subscription::update($subscription->id, [
                    'cancel_at_period_end' => true,
                ]);

                if ($response->status === 'active' && !$response->cancel_at_period_end) {
                    $notCancelled[] = $subscription->id;
                }
            }

            // Provide feedback to the user based on the results of the cancellation attempts
            if (empty($notCancelled)) {
                $this->Flash->success(__('All active subscriptions have been marked for cancellation.'));
            } else {
                $this->Flash->warning(__('Some subscriptions could not be marked for cancellation. Please check manually.'));
            }

        } catch (\Stripe\Exception\ApiErrorException $e) {
            $this->Flash->error(__('Error processing request: ') . $e->getMessage());
        }

        return $this->redirect(['action' => 'index']);
    }
}
