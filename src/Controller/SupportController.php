<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Mailer;

/**
 * Grades Controller
 *
 * @property \App\Model\Table\GradesTable $Grades
 * @method \App\Model\Entity\Grade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SupportController extends AppController
{
public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['reportIssue']);
    }

public function reportIssue()
{
    if ($this->request->is('post')) {
        $data = $this->request->getData();

	$currentUser = $this->Authentication->getIdentity();

        $browser = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $ipAddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
        $requestURI = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $emailBody = $data['issue'] . "\n\nBrowser: " . $browser . "\nIP Address: " . $ipAddress . "\nRequest URI: " . $requestURI . "\nRequest Method: " . $requestMethod;

        $mailer = new Mailer('default');
        $mailer->setTransport('default'); //your email configuration name
        $mailer->setTo('support@myhomelearner.com')
            ->setFrom([$currentUser->email => $currentUser->first_name . ' ' . $currentUser->last_name]) // using the email and name from currentUser
            ->setSubject($data['issueSubject'])
            ->deliver($emailBody);

        // If you want to display a flash message upon form submission
        $this->Flash->success('Issue reported successfully.');

        return $this->redirect($this->referer());
    }
}


}
