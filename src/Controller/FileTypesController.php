<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * FileTypes Controller
 *
 * @property \App\Model\Table\FileTypesTable $FileTypes
 * @method \App\Model\Entity\FileType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FileTypesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('AuditLog');
    }
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

        $fileTypes = $this->paginate($this->FileTypes);

        // Perform authorization checks on the paginated results
        foreach ($fileTypes as $fileType) {
            $this->Authorization->authorize($fileType);
        }

        $this->set(compact('fileTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id File Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fileType = $this->FileTypes->get($id, [
            'contain' => ['Files'],
        ]);
        $this->Authorization->authorize($fileType);

        $this->set(compact('fileType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fileType = $this->FileTypes->newEmptyEntity();
        $this->Authorization->authorize($fileType);
        if ($this->request->is('post')) {
            $fileType = $this->FileTypes->patchEntity($fileType, $this->request->getData());
            if ($this->FileTypes->save($fileType)) {
                $this->Flash->success(__('The file type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file type could not be saved. Please, try again.'));
        }

        $this->set(compact('fileType'));

        AuditLogger::log([
            'id' => \Cake\Utility\Text::uuid(),
            'message' => 'Something happened.',
            'user_id' => 'testusr',
            'component_name' => 'SomeComponent',
            'action_name' => 'someAction',
            'ip' => 'testip',
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id File Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fileType = $this->FileTypes->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($fileType);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fileType = $this->FileTypes->patchEntity($fileType, $this->request->getData());
            if ($this->FileTypes->save($fileType)) {
                $this->Flash->success(__('The file type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file type could not be saved. Please, try again.'));
        }

        $this->set(compact('fileType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fileType = $this->FileTypes->get($id);

        $this->Authorization->authorize($fileType);

        if ($this->FileTypes->delete($fileType)) {
            $this->Flash->success(__('The file type has been deleted.'));
        } else {
            $this->Flash->error(__('The file type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
