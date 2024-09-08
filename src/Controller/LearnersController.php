<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Chronos\Chronos;
use Cake\Http\Exception\NotFoundException;
use Cake\Validation\Validator;
use Cake\Filesystem\File;

/**
 * Learners Controller
 *
 * @property \App\Model\Table\LearnersTable $Learners
 * @method \App\Model\Entity\Learner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LearnersController extends AppController
{
    public $Audits = null;
    public $Notifications = null;

    public function initialize(): void
    {
        parent::initialize();

        // Loading models explicitly
        $this->loadModel('Audits');
        $this->loadModel('Notifications');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['index']);
    }
    public function index()
    {
        // Check if user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $currentUserId = $this->Authentication->getIdentity()->id;

        // Specify the custom finder in your paginate settings
        $this->paginate = [
            'finder' => [
                'forCurrentUser' => ['currentUserId' => $currentUserId]
            ]
        ];

        // Use paginate to fetch learners associated with the currently authenticated user
        $learners = $this->paginate($this->Learners);

        // Calculate the age for each learner using map
        $learners = $learners->map(function ($learner) {
            // Convert both dates to FrozenTime before comparison
            $dob = new FrozenTime($learner->date_of_birth);
            $learner->age = $dob->diffInYears(FrozenTime::now());
            return $learner;
        });

        $this->set(compact('learners'));
    }
    public function view($id = null)
    {
        // Ensure user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $currentUser = $this->Authentication->getIdentity()->id;

        // Fetch the learner with related data
        $learner = $this->Learners->get($id, [
            'contain' => [
                'Users',
                'Files' => ['FileTypes'],
                'Journal',
                'Courses' => [
                    'Subjects' => ['sort' => ['Subjects.name' => 'ASC']],
                    'Grades',
                    'SchoolYears' => ['sort' => ['SchoolYears.name' => 'ASC']]
                ],
                'Honors',
                'Activities',
                'Jobs'
            ],
        ]);

        // Check if learner belongs to the current user
        //if ($learner->user_id !== $currentUser) {
        //    $this->Flash->error(__('Access denied.'));
        //    return $this->redirect(['action' => 'index']);
        //}

        // Authorize the action
        $this->Authorization->authorize($learner);

        // Fetch the matching audit records for the learner
        $audits = $this->Audits->find()
            ->where(['record_id' => $id])
            ->order(['created' => 'DESC'])
            ->all();

        // Set data for the view
        $this->set(compact('learner', 'audits'));
    }
    public function add($id = null)
    {
        // Ensure user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $currentUser = $this->Authentication->getIdentity()->id;
        $learner = $this->Learners->newEmptyEntity();

        if ($this->request->is('post')) {
            $learner->user_id = $currentUser;
            $learner = $this->Learners->patchEntity($learner, $this->request->getData());

            if ($this->Learners->save($learner)) {
                $this->Flash->success(__('The learner has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The learner could not be saved. Please, try again.'));
            }
        }

        // Fetch associated files for the current user
        $files = $this->Learners->Files->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'order' => ['filename' => 'ASC'],
            'conditions' => ['user_id' => $currentUser]
        ])->all();

        // If the user is an admin (has admin value of 1), fetch all users to allow assignment of learners
        if ($this->Authentication->getIdentity()->admin == 1) {
            $users = $this->Learners->Users->find('list', [
                'keyField' => 'id',
                'valueField' => function ($learner) {
                    return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
                },
                'order' => ['Users.last_name' => 'ASC']
            ])->all();
        }

        // Authorize the action for the learner
        $this->Authorization->authorize($learner);

        // Set data for the view
        $this->set(compact('learner', 'users', 'files'));
    }
    public function edit($id = null, $userId = null)
    {
        // Ensure user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $currentUser = $this->Authentication->getIdentity()->id;

        $learner = $this->Learners->get($id, ['contain' => ['Files']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $learner = $this->Learners->patchEntity($learner, $this->request->getData());

            if ($this->Learners->save($learner)) {
                $this->Flash->success(__('The learner has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The learner could not be saved. Please, try again.'));
            }
        }

        // Fetch associated files for the current user
        $files = $this->Learners->Files->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'order' => ['filename' => 'ASC'],
            'conditions' => ['user_id' => $currentUser]
        ])->all();

        // If the user is an admin (has admin value of 1), fetch all users to allow reassignment of learners
        if ($this->Authentication->getIdentity()->admin == 1) {
            $users = $this->Learners->Users->find('list', [
                'keyField' => 'id',
                'valueField' => function ($learner) {
                    return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
                },
                'order' => ['Users.last_name' => 'ASC']
            ])->all();
        }

        // Authorize the action for the learner
        $this->Authorization->authorize($learner);

        // Set data for the view
        $this->set(compact('learner', 'files', 'users'));
    }
    public function delete($id = null)
    {
        // Ensure user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->request->allowMethod(['post', 'delete']);
        try {
            $learner = $this->Learners->get($id);

            $this->Authorization->authorize($learner);

            if ($this->Learners->delete($learner)) {
                $this->Flash->success(__('The learner has been deleted.'));
            } else {
                $this->Flash->error(__('The learner could not be deleted. Please, try again.'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__('An error occurred: ') . $e->getMessage());
        }

        return $this->redirect(['action' => 'index']);
    }
    public function pdf($id = null)
    {
        // Ensure user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        try {
            $learner = $this->Learners->get($id, [
                'contain' => ['Users', 'Files' => ['FileTypes'], 'Journal', 'Courses' => ['Subjects', 'Grades', 'SchoolYears'], 'Honors', 'Activities', 'Jobs'],
            ]);

            $this->Authorization->authorize($learner);

            $totalCredits = 0;
            $weightedGradePoints = 0;

            foreach ($learner->courses as $course) {
                $totalCredits += $course->credits;
                $weightedGradePoints += ($course->credits * $course->grade->value);
            }
            $gpa = ($totalCredits > 0) ? ($weightedGradePoints / $totalCredits) : 0;

            $name = ($learner->first_name . $learner->last_name);
            $time = FrozenTime::now()->i18nFormat('yyyyMMddHHmmss');

            $this->viewBuilder()->enableAutoLayout(false);
            $this->viewBuilder()->setClassName('CakePdf.Pdf');
            $this->viewBuilder()->setOption(
                'pdfConfig',
                [
                    'orientation' => 'portrait',
                    'download' => true,
                    'filename' => 'Transcript_' . $name . '_' . $time . '.pdf'
                ]
            );

            $this->viewBuilder()->setTemplatePath('Learners');
            $this->viewBuilder()->setTemplate('pdf');
            $pdf = $this->viewBuilder()->build()->render();

            $pdfPath = WWW_ROOT . 'generated' . DS . 'Transcript_' . $name . '_' . $time . '.pdf';
            $file = new File($pdfPath, true, 0644);
            if (!$file->write($pdf)) {
                throw new \Exception("Failed to save PDF");
            }
            $file->close();

        } catch (\Exception $e) {
            $this->Flash->error(__('An error occurred: ') . $e->getMessage());
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('learner', 'gpa', 'pdf'));
    }
    public function graduate($id) {
        // Ensure user is authenticated
        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You are not authenticated.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $learner = $this->Learners->get($id);

        $this->Authorization->authorize($learner);

        $learner->graduated = !$learner->graduated;
        $learner->graduated = (int)$learner->graduated; // cast boolean to integer

        if ($this->Learners->save($learner)) {
            $this->Flash->success(__('The graduated status has been changed.'));
        } else {
            $this->Flash->error(__('The graduated status could not be modified. Please try again.'));
        }

        return $this->redirect(['action' => 'view', $id]);
    }
}
