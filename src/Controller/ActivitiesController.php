<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivitiesTable $Activities
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization(['index']);
    }
    public function index()
    {
        $currentUserId = $this->Authentication->getIdentity()->id;

        $activities = $this->paginate(
            $this->Activities->find('withUsersAndLearners')
                ->where(['Activities.user_id' => $currentUserId])
        );

        $this->set(compact('activities'));
    }
    public function view($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Users', 'Learners'],
        ]);
        $learners = $this->Activities->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $activity->user_id] // Only show records where user_id = $userId
        ])->all();
        $this->Authorization->authorize($activity);
        $this->set(compact('activity', 'learners'));
    }
    public function add($userId = null)
    {
        $activity = $this->Activities->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        // Ensure only admin can set another user's ID, or default to the current user's ID
        $userId = ($currentUser->admin || $userId === null) ? $currentUser->id : throw new ForbiddenException('Non-admin users cannot pass optional parameters.');

        if ($this->request->is('post')) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            $activity->user_id = $currentUser->id;

            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The activity could not be saved. Please, try again.'));
        }

        $users = $this->Activities->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();

        $learners = $this->Activities->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId]
        ])->all();

        $this->Authorization->authorize($activity);
        $this->set(compact('activity', 'users', 'learners'));
    }
    public function edit($id = null, $userId = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Learners'],
        ]);
        $currentUser = $this->Authentication->getIdentity();

        // Ensure only admins can edit another user's data, or default to the current user's ID.
        $userId = ($currentUser->admin || $userId === null) ? $currentUser->id : throw new ForbiddenException('Non-admin users can only pass their own user ID as a parameter.');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());

            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The activity could not be saved. Please, try again.'));
        }

        $users = $this->Activities->Users->find('list', [
            'limit' => 200,
            'keyField' => 'id',
            'valueField' => function ($user) {
                return $user->last_name . ', ' . $user->first_name . ' (' . $user->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();

        $learners = $this->Activities->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId]
        ])->all();

        $this->Authorization->authorize($activity);
        $this->set(compact('activity', 'users', 'learners'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activity = $this->Activities->get($id);

        $this->Authorization->authorize($activity);

        if ($this->Activities->delete($activity)) {
            $this->Flash->success(__('The activity has been deleted.'));
        } else {
            $this->Flash->error(__('The activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
