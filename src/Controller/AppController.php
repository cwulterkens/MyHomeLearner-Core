<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\AuthenticationComponent;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use \Cake\Utility\Hash;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
        $this->set('currentUser', $this->Authentication->getIdentity());

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        $browser = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $ipAddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
        $requestURI = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Make this variable available to all views
        $this->set('browser', $browser);
        $this->set('ipAddress', $ipAddress);
        $this->set('requestURI', $requestURI);
        $this->set('requestMethod', $requestMethod);
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity) {
            $userId = $identity->get('id');
            $notificationsTable = TableRegistry::getTableLocator()->get('Notifications');
            $notificationsCount = $notificationsTable->find()->where(['user_id' => $userId, 'viewed' => 0])->count();
            $notificationsList = $notificationsTable->find()
                ->where(['user_id' => $userId, 'viewed' => 0])
                ->limit(5)
                ->all();
            $this->set(compact('notificationsCount'));
            $this->set(compact('notificationsList'));
            $this->set(compact('userId'));
        }
    }
}
