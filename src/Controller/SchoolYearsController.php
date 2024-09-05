<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SchoolYears Controller
 *
 * @property \App\Model\Table\SchoolYearsTable $SchoolYears
 * @method \App\Model\Entity\SchoolYear[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolYearsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'order' => ['name' => 'ASC'] // Order by name field in ascending order
        ];

        $schoolYears = $this->paginate($this->SchoolYears);

        // Perform authorization checks on the paginated results
        foreach ($schoolYears as $schoolYear) {
            $this->Authorization->authorize($schoolYear);
        }

        $this->set(compact('schoolYears'));
    }

    /**
     * View method
     *
     * @param string|null $id School Year id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolYear = $this->SchoolYears->get($id, [
            'contain' => ['Courses'],
        ]);
        $this->Authorization->authorize($schoolYear);

        $this->set(compact('schoolYear'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schoolYear = $this->SchoolYears->newEmptyEntity();
        if ($this->request->is('post')) {
            $schoolYear = $this->SchoolYears->patchEntity($schoolYear, $this->request->getData());
            if ($this->SchoolYears->save($schoolYear)) {
                $this->Flash->success(__('The school year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school year could not be saved. Please, try again.'));
        }
        $this->Authorization->authorize($schoolYear);

        $this->set(compact('schoolYear'));
    }

    /**
     * Edit method
     *
     * @param string|null $id School Year id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolYear = $this->SchoolYears->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolYear = $this->SchoolYears->patchEntity($schoolYear, $this->request->getData());
            if ($this->SchoolYears->save($schoolYear)) {
                $this->Flash->success(__('The school year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school year could not be saved. Please, try again.'));
        }
        $this->Authorization->authorize($schoolYear);

        $this->set(compact('schoolYear'));
    }

    /**
     * Delete method
     *
     * @param string|null $id School Year id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolYear = $this->SchoolYears->get($id);

        $this->Authorization->authorize($schoolYear);

        if ($this->SchoolYears->delete($schoolYear)) {
            $this->Flash->success(__('The school year has been deleted.'));
        } else {
            $this->Flash->error(__('The school year could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
