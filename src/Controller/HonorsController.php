<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Honors Controller
 *
 * @property \App\Model\Table\HonorsTable $Honors
 * @method \App\Model\Entity\Honor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HonorsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['index']);
    }

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

        $honors = $this->paginate($this->Honors);
        $this->set(compact('honors'));
    }

    public function view($id = null)
    {
        $honor = $this->Honors->get($id, [
            'contain' => ['Learners'],
        ]);

        $this->Authorization->authorize($honor);
        $learners = $this->Honors->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $honor->user_id] // Only show records where user_id = $userId
        ])->all();

        $this->set(compact('honor', 'learners'));
    }

    public function add($userId = null)
    {
        $honor = $this->Honors->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        if ($currentUser->admin === 0 && $userId !== null) {
            throw new ForbiddenException('Non-admin users cannot pass optional parameters.');
        }
        $userId = ($userId !== null) ? $userId : $this->Authentication->getIdentity()->get('id');
        if ($this->request->is('post')) {
        $honor->user_id = $currentUser->id;
            $honor = $this->Honors->patchEntity($honor, $this->request->getData());
            if ($this->Honors->save($honor)) {
                $this->Flash->success(__('The honor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The honor could not be saved. Please, try again.'));
        }
        $users = $this->Honors->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();
        $learners = $this->Honors->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $this->Authorization->authorize($honor);
        $this->set(compact('honor', 'users', 'learners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Honor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $userId = null)
    {
        $honor = $this->Honors->get($id, [
            'contain' => ['Learners'],
        ]);
        $currentUser = $this->Authentication->getIdentity();
        $userId = ($userId !== null) ? $userId : $currentUser->id;

        // If the user is not an admin and the userId parameter does not match their own ID
        if ($currentUser->admin === 0 && $userId !== $currentUser->id) {
            throw new ForbiddenException('Non-admin users can only pass their own user ID as a parameter.');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $honor = $this->Honors->patchEntity($honor, $this->request->getData());
            if ($this->Honors->save($honor)) {
                $this->Flash->success(__('The honor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The honor could not be saved. Please, try again.'));
        }
        $users = $this->Honors->Users->find('list', ['limit' => 200])->all();
        $learners = $this->Honors->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $this->Authorization->authorize($honor);
        $this->set(compact('honor', 'users', 'learners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Honor id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $honor = $this->Honors->get($id);

        $this->Authorization->authorize($honor);

        if ($this->Honors->delete($honor)) {
            $this->Flash->success(__('The honor has been deleted.'));
        } else {
            $this->Flash->error(__('The honor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
