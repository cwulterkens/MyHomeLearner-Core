<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AuditLogger;
use Cake\I18n\FrozenTime;
use Cake\Filesystem\File;
use Cake\Log\Log;

/**
 * Learners Controller
 *
 * @property \App\Model\Table\LearnersTable $Learners
 * @method \App\Model\Entity\Learner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LearnersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Audits');
        $this->loadModel('Notifications');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        if (!$this->Authentication->getIdentity()) {
            $this->Flash->error(__('You must be logged in to access this page.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->Authorization->skipAuthorization(['index']);
    }

    public function index()
    {
        $currentUserId = $this->Authentication->getIdentity()->id;

        $this->paginate = [
            'finder' => [
                'forCurrentUser' => ['currentUserId' => $currentUserId]
            ],
            'limit' => 20,
        ];

        $learners = $this->paginate($this->Learners)->map(function ($learner) {
            $dob = new FrozenTime($learner->date_of_birth);
            $learner->age = $dob->diffInYears(FrozenTime::now());
            return $learner;
        });

        $this->set(compact('learners'));
    }

    public function view($id = null)
    {
        $learner = $this->Learners->get($id, [
            'fields' => ['id', 'first_name', 'last_name', 'graduation_date'],
            'contain' => [
                'Users' => ['fields' => ['id', 'first_name', 'last_name']],
                'Files' => ['fields' => ['id', 'name', 'file_type_id']],
                'Journal', 'Courses' => [
                    'Subjects' => ['fields' => ['id', 'name']],
                    'Grades',
                    'SchoolYears' => ['fields' => ['id', 'name']]
                ], 'Honors', 'Activities', 'Jobs'
            ],
        ]);

        $this->Authorization->authorize($learner);

        $audits = $this->Audits->find()
            ->where(['record_id' => $id])
            ->order(['created' => 'DESC'])
            ->all();

        $this->set(compact('learner', 'audits'));
    }

    public function add()
    {
        $currentUser = $this->Authentication->getIdentity()->id;
        $learner = $this->Learners->newEmptyEntity();

        if ($this->request->is('post')) {
            $learner->user_id = $currentUser;
            $learner = $this->Learners->patchEntity($learner, $this->request->getData());

            if ($this->Learners->save($learner)) {
                AuditLogger::log([
                    'id' => \Cake\Utility\Text::uuid(),
                    'message' => 'Added learner',
                    'user_id' => $currentUser,
                    'record_id' => $learner->id,
                    'component_name' => 'LearnersController',
                    'action_name' => 'add',
                    'ip' => $this->request->clientIp(),
                ]);

                $this->Flash->success(__('The learner has been saved.'));
                return $this->redirect(['action' => 'view', $learner->id]);
            } else {
                $this->Flash->error(__('The learner could not be saved. Please, try again.'));
            }
        }

        $files = Cache::remember('files_list_' . $currentUser, function () use ($currentUser) {
            return $this->Learners->Files->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
                'conditions' => ['user_id' => $currentUser],
            ])->all();
        });

        $users = null;
        if ($this->Authentication->getIdentity()->admin == 1) {
            $users = $this->Learners->Users->find('list', [
                'keyField' => 'id',
                'valueField' => function ($learner) {
                    return $learner->last_name . ', ' . $learner->first_name;
                },
                'order' => ['Users.last_name' => 'ASC']
            ])->all();
        }

        $this->Authorization->authorize($learner);

        $this->set(compact('learner', 'users', 'files'));
    }

    public function edit($id = null)
    {
        $currentUser = $this->Authentication->getIdentity()->id;
        $learner = $this->Learners->get($id, ['contain' => ['Files']]);
        $this->Authorization->authorize($learner);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $originalData = $learner->toArray();
            $learner = $this->Learners->patchEntity($learner, $this->request->getData());

            if ($this->Learners->save($learner)) {
                $excludedFields = ['modified', 'created'];
                $changes = [];
                foreach ($originalData as $field => $originalValue) {
                    if (in_array($field, $excludedFields, true)) {
                        continue;
                    }

                    $newValue = $learner->get($field);
                    if ($originalValue === $newValue) {
                        continue;
                    }

                    $changes[] = sprintf(
                        '%s: "%s" -> "%s"',
                        $field,
                        htmlspecialchars($originalValue ?? '(null)', ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($newValue ?? '(null)', ENT_QUOTES, 'UTF-8')
                    );
                }

                if (!empty($changes)) {
                    AuditLogger::log([
                        'id' => \Cake\Utility\Text::uuid(),
                        'message' => sprintf('Edited learner. Changes: %s', implode(', ', $changes)),
                        'user_id' => $currentUser,
                        'record_id' => $learner->id,
                        'component_name' => 'LearnersController',
                        'action_name' => 'edit',
                        'ip' => $this->request->clientIp(),
                    ]);
                }

                $this->Flash->success(__('The learner has been saved.'));
                return $this->redirect(['action' => 'view', $learner->id]);
            } else {
                $this->Flash->error(__('The learner could not be saved. Please, try again.'));
            }
        }

        $files = $this->Learners->Files->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => ['user_id' => $currentUser],
        ])->all();

        $users = null;
        if ($this->Authentication->getIdentity()->admin == 1) {
            $users = $this->Learners->Users->find('list', [
                'keyField' => 'id',
                'valueField' => function ($learner) {
                    return $learner->last_name . ', ' . $learner->first_name;
                },
                'order' => ['Users.last_name' => 'ASC']
            ])->all();
        }

        $this->set(compact('learner', 'files', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $currentUser = $this->Authentication->getIdentity()->id;

        try {
            $learner = $this->Learners->get($id);
            $this->Authorization->authorize($learner);

            if ($this->Learners->delete($learner)) {
                AuditLogger::log([
                    'id' => \Cake\Utility\Text::uuid(),
                    'message' => 'Deleted learner',
                    'user_id' => $currentUser,
                    'record_id' => $id,
                    'component_name' => 'LearnersController',
                    'action_name' => 'delete',
                    'ip' => $this->request->clientIp(),
                ]);

                $this->Flash->success(__('The learner has been deleted.'));
            } else {
                $this->Flash->error(__('The learner could not be deleted. Please, try again.'));
            }
        } catch (\Exception $e) {
            Log::error('Error in delete action: ' . $e->getMessage());
            $this->Flash->error(__('An error occurred while processing your request. Please try again later.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function pdf($id = null)
    {
        $learner = $this->Learners->get($id, [
            'contain' => [
                'Users', 'Files' => ['FileTypes'], 'Journal', 'Courses' => [
                    'Subjects', 'Grades', 'SchoolYears'
                ], 'Honors', 'Activities', 'Jobs'
            ],
        ]);

        $this->Authorization->authorize($learner);

        $currentUser = $this->Authentication->getIdentity()->id;

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
        AuditLogger::log([
            'id' => \Cake\Utility\Text::uuid(),
            'message' => 'Transcript Generated',
            'user_id' => $currentUser,
            'record_id' => $id,
            'component_name' => 'LearnersController',
            'action_name' => 'pdf',
            'ip' => $this->request->clientIp(),
        ]);

        $this->set(compact('learner', 'gpa', 'pdf'));
    }

    public function graduate($id) {
        $learner = $this->Learners->get($id);

        $this->Authorization->authorize($learner);

        $currentUser = $this->Authentication->getIdentity()->id;

        $learner->graduated = !$learner->graduated;
        $learner->graduated = (int)$learner->graduated; // cast boolean to integer

        if ($this->Learners->save($learner)) {
            $this->Flash->success(__('The graduated status has been changed.'));
            AuditLogger::log([
                'id' => \Cake\Utility\Text::uuid(),
                'message' => 'Learner Graduated',
                'user_id' => $currentUser,
                'record_id' => $id,
                'component_name' => 'LearnersController',
                'action_name' => 'graduate',
                'ip' => $this->request->clientIp(),
            ]);
        } else {
            $this->Flash->error(__('The graduated status could not be modified. Please try again.'));
        }

        return $this->redirect(['action' => 'view', $id]);
    }
}
