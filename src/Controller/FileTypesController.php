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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fileTypes = $this->paginate($this->FileTypes);

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
        if ($this->request->is('post')) {
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
        if ($this->FileTypes->delete($fileType)) {
            $this->Flash->success(__('The file type has been deleted.'));
        } else {
            $this->Flash->error(__('The file type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
