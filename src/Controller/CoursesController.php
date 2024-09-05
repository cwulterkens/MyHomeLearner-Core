<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
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

        // Configure the pagination using the custom finder method
        $this->paginate = [
            'finder' => [
                'forUser' => [
                    'user_id' => $currentUserId
                ]
            ]
        ];

        $courses = $this->paginate($this->Courses);
        $this->set(compact('courses'));
    }

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Subjects', 'Users', 'SchoolYears', 'Learners', 'Grades'],
        ]);

        $this->Authorization->authorize($course);

        $this->set(compact('course'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $course = $this->Courses->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        if ($currentUser->admin === 0 && $userId !== null) {
            throw new ForbiddenException('Non-admin users cannot pass optional parameters.');
        }
$course->user_id = $currentUser->id;
        $userId = ($userId !== null) ? $userId : $this->Authentication->getIdentity()->get('id');
        if ($this->request->is('post')) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200])->all();
        $users = $this->Courses->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();
        $schoolYears = $this->Courses->SchoolYears->find('list', [
            'limit' => 20,
            'order' => ['name' => 'DESC'],
        ])->all();
        $learners = $this->Courses->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $grades = $this->Courses->Grades->find('list', [
            'limit' => 200,
            'order' => ['value' => 'DESC']
        ])->all();
        $this->Authorization->authorize($course);
        $this->set(compact('course', 'subjects', 'users', 'schoolYears', 'learners', 'grades'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $userId = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => [],
        ]);
        $currentUser = $this->Authentication->getIdentity();
        $userId = ($userId !== null) ? $userId : $currentUser->id;

        // If the user is not an admin and the userId parameter does not match their own ID
        if ($currentUser->admin === 0 && $userId !== $currentUser->id) {
            throw new ForbiddenException('Non-admin users can only pass their own user ID as a parameter.');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200])->all();
        $users = $this->Courses->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($learner) {
                return $learner->last_name . ', ' . $learner->first_name . ' (' . $learner->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();
        $schoolYears = $this->Courses->SchoolYears->find('list', [
            'limit' => 20,
            'order' => ['name' => 'DESC'],
        ])->all();
        $learners = $this->Courses->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId] // Only show records where user_id = $userId
        ])->all();
        $grades = $this->Courses->Grades->find('list', [
            'limit' => 200,
            'order' => ['value' => 'DESC']
        ])->all();
        $this->Authorization->authorize($course);
        $this->set(compact('course', 'subjects', 'users', 'schoolYears', 'learners', 'grades'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);

        $this->Authorization->authorize($course);

        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
