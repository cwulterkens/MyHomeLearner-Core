<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $currentUserId = $this->Authentication->getIdentity()->id;

        $this->paginate = [
            'finder' => [
                'forUser' => [
                    'user_id' => $currentUserId
                ]
            ]
        ];

        $jobs = $this->paginate($this->Jobs);
        $this->set(compact('jobs'));
    }

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Learners', 'Users'],
        ]);

        $learners = $this->Jobs->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $job->user_id] // Only show records where user_id = $userId
        ])->all();

        $this->Authorization->authorize($job);

        $this->set(compact('job','learners'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $job = $this->Jobs->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        if ($currentUser->admin === 0 && $userId !== null) {
            throw new ForbiddenException('Non-admin users cannot pass optional parameters.');
        }
        $userId = ($userId !== null) ? $userId : $this->Authentication->getIdentity()->get('id');
        if ($this->request->is('post')) {
$job->user_id = $currentUser->id;
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $users = $this->Jobs->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();
        $learners = $this->Jobs->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();

        $this->Authorization->authorize($job);

        $this->set(compact('job', 'learners', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $userId = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => [],
        ]);
        $currentUser = $this->Authentication->getIdentity();
        $userId = ($userId !== null) ? $userId : $currentUser->id;

        // If the user is not an admin and the userId parameter does not match their own ID
        if ($currentUser->admin === 0 && $userId !== $currentUser->id) {
            throw new ForbiddenException('Non-admin users can only pass their own user ID as a parameter.');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $learners = $this->Jobs->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $users = $this->Jobs->Users->find('list', ['limit' => 200])->all();

        $this->Authorization->authorize($job);

        $this->set(compact('job', 'learners', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $job = $this->Jobs->get($id);

        $this->Authorization->authorize($job);

        if ($this->Jobs->delete($job)) {
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
