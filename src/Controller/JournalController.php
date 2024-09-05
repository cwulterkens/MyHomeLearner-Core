<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Journal Controller
 *
 * @property \App\Model\Table\JournalTable $Journal
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JournalController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['index']);
    }

    public function index()
    {
        $currentUserId = $this->Authentication->getIdentity()->id;

        // Configure the pagination to use the custom finder method
        $this->paginate = [
            'finder' => [
                'forUser' => [
                    'user_id' => $currentUserId
                ]
            ]
        ];

        $journal = $this->paginate($this->Journal);
        $this->set(compact('journal'));
    }

    public function view($id = null)
    {
        $journal = $this->Journal->get($id, [
            'contain' => ['Users', 'Learners'],
        ]);
        $this->Authorization->authorize($journal);

        $this->set(compact('journal'));
    }

    public function add($userId = null)
    {
        $journal = $this->Journal->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        if ($currentUser->admin === 0 && $userId !== null) {
            throw new ForbiddenException('Non-admin users cannot pass optional parameters.');
        }
        $userId = ($userId !== null) ? $userId : $this->Authentication->getIdentity()->get('id');
        if ($this->request->is('post')) {
            $journal = $this->Journal->patchEntity($journal, $this->request->getData());
            $journal->user_id = $currentUser->id;
            if ($this->Journal->save($journal)) {
                $this->Flash->success(__('The journal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The journal could not be saved. Please, try again.'));
        }

        $users = $this->Journal->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();

        $learners = $this->Journal->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $this->Authorization->authorize($journal);

        $this->set(compact('journal', 'users', 'learners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $userId = null)
    {
        $journal = $this->Journal->get($id, [
            'contain' => ['Learners'],
        ]);
        $currentUser = $this->Authentication->getIdentity();
        $userId = ($userId !== null) ? $userId : $currentUser->id;

        // If the user is not an admin and the userId parameter does not match their own ID
        if ($currentUser->admin === 0 && $userId !== $currentUser->id) {
            throw new ForbiddenException('Non-admin users can only pass their own user ID as a parameter.');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $journal = $this->Journal->patchEntity($journal, $this->request->getData());
            if ($this->Journal->save($journal)) {
                $this->Flash->success(__('The journal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The journal could not be saved. Please, try again.'));
        }

        $users = $this->Journal->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();

        $learners = $this->Journal->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $this->Authorization->authorize($journal);

        $this->set(compact('journal', 'users', 'learners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Journal id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $journal = $this->Journal->get($id);

        $this->Authorization->authorize($journal);

        if ($this->Journal->delete($journal)) {
            $this->Flash->success(__('The journal has been deleted.'));
        } else {
            $this->Flash->error(__('The journal could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
