<?php

namespace App\Controller;

use Cake\Chronos\Chronos;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
use Stripe;

class AdminController extends AppController
{
    public $Users = null;
    public $Learners = null;
    public $Activities = null;
    public $Jobs = null;
    public $Honors = null;
    public $Journal = null;
    public $Files = null;
    public $Courses = null;
    public $JournalLearners = null;
    public $ActivitiesLearners = null;
    public $HonorsLearners = null;
    public $FilesLearners = null;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $user = $this->request->getAttribute('identity');
        if ($user->admin == 0) {
            $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);
        }
        $this->Authorization->skipAuthorization(['index']);
    }

    public function initialize(): void
    {
        parent::initialize();

        require_once VENDOR_PATH. '/stripe/stripe-php/init.php';

        Stripe\Stripe::setApiKey(STRIPE_SECRET);

    }
    public function index()
    {

    }
    public function financials()
    {

    }
public function usage() {
    $this->loadModel('Users');
    $this->loadModel('Learners');
    $this->loadModel('Activities');
    $this->loadModel('Jobs');
    $this->loadModel('Honors');
    $this->loadModel('Journal');
    $this->loadModel('Files');
    $this->loadModel('Courses');

    $date = new FrozenTime('30 days ago');

    // Generate a full list of dates for the last 30 days
    $dateRange = [];
    for ($i = 0; $i < 30; $i++) {
        $dateRange[date('Y-m-d', strtotime('-' . $i . ' days'))] = 0;
    }

    // Function to get the records and merge with the full date range
    $getData = function($model) use ($date, $dateRange) {
        $recordsCreated = $model->find()
            ->select([
                'date' => $model->find()->func()->date([
                    'created' => 'identifier'
                ]),
                'count' => $model->find()->func()->count('*')
            ])
            ->where([
                'created >=' => $date
            ])
            ->group([
                'date'
            ])
            ->toArray();

        // Merge the database data with the full list of dates
        foreach ($recordsCreated as $record) {
            $dateRange[$record['date']] = $record['count'];
        }

        // Make sure the dates are in the correct order
        ksort($dateRange);

        return $dateRange;
    };

    // Get the data and set to the view
    $this->set('usersCreated', $getData($this->Users));
    $this->set('learnersCreated', $getData($this->Learners));

    // Define the countable models
    $countableModels = ['Activities', 'Jobs', 'Honors', 'Journal', 'Files', 'Courses'];

    // Get total counts for each model
    $totalCounts = array_reduce($countableModels, function($counts, $modelName) {
        $counts[$modelName] = $this->$modelName->find()->count();
        return $counts;
    }, []);

    $this->set('totalCounts', $totalCounts);

    // Plus-Minus 60 days revenue
    $end_date = new \DateTime(); // Use the global PHP namespace for DateTime
    $start_date_previous = (new \DateTime())->modify('-60 days');
    $end_date_next = new \DateTime(); // Use the current date for the end of the next period

    // Retrieve transactions
    $previous_transactions = \Stripe\BalanceTransaction::all([
        'created' => [
            'gte' => $start_date_previous->getTimestamp(),
            'lt' => $end_date->getTimestamp(),
        ],
        'type' => 'charge',
    ]);
    $next_transactions = \Stripe\BalanceTransaction::all([
        'created' => [
            'gte' => $end_date->getTimestamp(),
            'lt' => $end_date_next->getTimestamp(),
        ],
        'type' => 'charge',
    ]);

    // Function to fill in gaps with zeros
    function fill_gaps_with_zeros($data, $start_date, $end_date) {
        $dateRange = [];
        $current_date = clone $start_date;

        while ($current_date <= $end_date) {
            $date = $current_date->format('Y-m-d');
            $dateRange[$date] = isset($data[$date]) ? $data[$date] : 0;
            $current_date->modify('+1 day');
        }

        return $dateRange;
    }

    // Function to update revenue by day
    function update_revenue_by_day($transactions) {
        $revenue_by_day = [];
        foreach ($transactions->data as $transaction) {
            $transaction_date = date('Y-m-d', $transaction->created);
            $amount = $transaction->amount / 100; // Amounts are in cents, convert to dollars
            if (!isset($revenue_by_day[$transaction_date])) {
                $revenue_by_day[$transaction_date] = 0;
            }
            $revenue_by_day[$transaction_date] += $amount;
        }
        return $revenue_by_day;
    }

    // Update revenue by day
    $revenue_previous = update_revenue_by_day($previous_transactions);
    $revenue_next = update_revenue_by_day($next_transactions);

    // Fill in gaps with zeros for both periods
    $revenue_previous_filled = fill_gaps_with_zeros($revenue_previous, $start_date_previous, $end_date);
    $revenue_next_filled = fill_gaps_with_zeros($revenue_next, $end_date, $end_date_next);

    // Merge data for complete revenue by day
    $revenue_by_day = $revenue_previous_filled + $revenue_next_filled;

    // Set the revenue data to the view
    $this->set('revenueByDay', $revenue_by_day);
}


    public function notifications()
    {
        $usersTable = $this->getTableLocator()->get('Users');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $notificationsTable = $this->getTableLocator()->get('Notifications');

            if ($data['user_id'] == -1) {  // All Families selected

                $conditions = ['active' => 1, 'verified' => 1];

                if (isset($data['include_inactive'])) {
                    unset($conditions['active']);
                }

                if (isset($data['include_unverified'])) {
                    unset($conditions['verified']);
                }

                $families = $usersTable->find('all')->where($conditions)->toList();

                foreach ($families as $family) {
                    $emailStatus = 0; // Default status

                    $notification = $notificationsTable->newEntity([
                        'subject' => $data['subject'],
                        'content' => $data['content'],
                        'emailed' => $emailStatus,
                        //'user_id' => $family->id,
                        'user_id' => $data['user_id'],
                        'importance' => $data['importance'],
                        'created' => FrozenTime::now(),
                    ]);

                    if (isset($data['is_emailed'])) {
                        try {
                            $this->sendNotificationEmail($family, $notification);
                            $notification->emailed = 1; // Email sent successfully
                        } catch (Exception $e) {
                            $notification->emailed = 2; // Email failed to send
                        }
                    }

                    $notificationsTable->save($notification);
                }

                $this->Flash->success(__('Notifications have been saved for all families.'));
            } else {
                $emailStatus = 0; // Default status

                $notification = $notificationsTable->newEntity([
                    'subject' => $data['subject'],
                    'content' => $data['content'],
                    'emailed' => $emailStatus,
                    //'user_id' => $data['user_id'],
                    'user_id' => $data['user_id'],
                    'importance' => $data['importance'],
                    'created' => FrozenTime::now(),
                ]);

                if (isset($data['is_emailed'])) {
                    try {
                        $user = $usersTable->get($data['user_id']);
                        $this->sendNotificationEmail($user, $notification);
                        $notification->emailed = 1; // Email sent successfully
                    } catch (Exception $e) {
                        $notification->emailed = 2; // Email failed to send
                    }
                }

                if ($notificationsTable->save($notification)) {
                    $this->Flash->success(__('Notification has been saved.'));
                } else {
                    $this->Flash->error(__('Unable to save the notification. Please, try again.'));
                }
            }
        }

        $users = [-1 => 'All Families'] + $usersTable->find('list', [
                'keyField' => 'id',
                'valueField' => function ($learner) {
                    return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
                },
                'order' => ['last_name' => 'ASC']
            ])->toArray();

        $this->set(compact('users'));
    }

    public function notificationsDebug() {
        $usersTable = $this->getTableLocator()->get('Users');

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if ($data['user_id'] == -1) {  // All Families selected

                $conditions = ['active' => 1, 'verified' => 1];

                if (isset($data['include_inactive'])) {
                    unset($conditions['active']);
                }

                if (isset($data['include_unverified'])) {
                    unset($conditions['verified']);
                }

                $families = $usersTable->find('all')->where($conditions)->toList();

                // Here's the JSON output for debugging
                $this->response = $this->response->withType('json');
                $this->response->getBody()->write(json_encode($families));
                return $this->response;
            }
        }

        // ... rest of your code
    }



    public function learners()
    {
        // Load all necessary models
        $modelsToLoad = ['Learners', 'JournalLearners', 'ActivitiesLearners', 'HonorsLearners', 'FilesLearners', 'Courses', 'Jobs', 'Users'];
        array_map([$this, 'loadModel'], $modelsToLoad);

        $this->paginate = [
            'finder' => [
                'withUser' => []
            ],
            'contain' => ['Users'], // Include Users association here
        ];

        $currentUserId = $this->Authentication->getIdentity()->id;

        // Paginate learners with associated Users
        $learners = $this->paginate($this->Learners->find());

        // Define the countable models
        $countableModels = [
            'journalCount' => 'JournalLearners',
            'fileCount' => 'FilesLearners',
            'activityCount' => 'ActivitiesLearners',
            'courseCount' => 'Courses',
            'honorCount' => 'HonorsLearners',
            'jobCount' => 'Jobs',
        ];

        // Calculate counts for each learner
        foreach ($learners as $learner) {
            $learner = array_reduce(array_keys($countableModels), function ($learner, $countName) use ($countableModels) {
                $modelName = $countableModels[$countName];
                $learner->$countName = $this->$modelName->find()->where(['learner_id' => $learner->id])->count();
                return $learner;
            }, $learner);
        }

        $this->set(compact('learners'));
    }

    public function courses()
    {

    }
    public function files()
    {

    }
    public function journals()
    {

    }
    public function honors()
    {

    }
    public function jobs()
    {

    }
    public function activities()
    {

    }
    private function sendNotificationEmail($user, $notification)
    {
        try {
            $mailer = new Mailer('default');
            $mailer->viewBuilder()->setTemplate('notification');

            // Set email variables
            $mailer->setViewVars([
                'first_name' => $user->first_name,
                'subject' => $notification->subject,
                'content' => $notification->content,
            ]);

            $mailer->setTransport('default') // your email configuration name
            ->setFrom(['no-reply@myhomelearner.com' => 'MyHomeLearner'])
                ->setTo($user->email)  // assuming $user->email holds the email of the user
                ->setEmailFormat('html')
                ->setSubject($notification->subject);

            $mailer->send();
            return true;  // return true if email is sent successfully

        } catch (\Exception $e) {
            // Log the error message if needed
            //Log::error('Error sending email: ' . $e->getMessage());
            return false;  // return false if there's an error
        }
    }


}
