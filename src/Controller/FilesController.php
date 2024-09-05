<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\I18n\FrozenTime;
use Cake\Http\Exception\ForbiddenException;
class FilesController extends AppController
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
                'withRelatedData' => ['user_id' => $currentUserId]
            ]
        ];

        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
    }
    public function view($id = null)
    {
        if (!$id || !self::isValidUUID($id)) {
            $this->Flash->error(__('Invalid file ID.'));
            return $this->redirect(['action' => 'index']);
        }

        $file = $this->Files->get($id);

        $this->Authorization->authorize($file);

        $file = $this->Files->loadInto($file, ['FileTypes', 'Users', 'Learners']);

        $this->set(compact('file'));
    }
    public function add($userId = null)
    {
        $file = $this->Files->newEmptyEntity();
        $currentUser = $this->Authentication->getIdentity();

        if ($currentUser->admin === 0 && $userId !== null) {
            throw new ForbiddenException('Non-admin users cannot pass optional parameters.');
        }

        $userId = ($userId !== null) ? $userId : $currentUser->id;

        if ($this->request->is('post')) {
            $file->user_id = $currentUser->id;
            $object = $this->request->getData('file');

            $time = FrozenTime::now()->i18nFormat('yyyyMMddHHmmss');
            $filename = $time . '_' . $object->getClientFilename();

            $data = $this->request->getData();
            $data['filename'] = $filename;
            $file = $this->Files->patchEntity($file, $data);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
            if (!in_array($object->getClientMediaType(), $allowedMimeTypes)) {
                $this->Flash->error(__('Only images (PNG, JPG, or GIF) and PDF files are allowed.'));
                return $this->redirect(['action' => 'add']);
            }

            $path = WWW_ROOT . 'uploads' . DS . 'files' . DS . $file->user_id;
            $file->type = $object->getClientMediaType();
            $file->size = $object->getSize();
            $file->file_dir = DS . 'uploads' . DS . 'files' . DS . $file->user_id;

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $object->moveTo($path . DS . $filename);

            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }

        $fileTypes = $this->Files->FileTypes->find('list', ['limit' => 200])->all();
        $users = $this->Files->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($file) {
                return $file->last_name . ', ' . $file->first_name . ' (' . $file->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();

        $learners = $this->Files->Learners->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'order' => ['first_name' => 'ASC'],
            'conditions' => ['user_id' => $userId]
        ])->all();

        $this->Authorization->authorize($file);
        $this->set(compact('file', 'fileTypes', 'users', 'learners'));
    }
    public function edit($id = null, $userId = null)
    {
        $file = $this->Files->get($id, ['contain' => ['Learners']]);
        $currentUser = $this->Authentication->getIdentity();
        $userId = $userId ?? $currentUser->id;  // Use null coalescing operator for brevity

        if (!$currentUser->admin && $userId !== $currentUser->id) {
            throw new ForbiddenException('Non-admin users can only pass their own user ID as a parameter.');
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());

            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }

        $fileTypes = $this->Files->FileTypes->find('list', ['limit' => 200])->all();

        $users = $this->Files->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($file) {
                return $file->last_name . ', ' . $file->first_name . ' (' . $file->id . ')';
            },
            'order' => ['Users.last_name' => 'ASC']
        ])->all();

        $learnerConditions = ['keyField' => 'id', 'valueField' => 'first_name', 'order' => ['first_name' => 'ASC']];
        if ($userId) {
            $learnerConditions['conditions'] = ['user_id' => $userId];
        }
        $learners = $this->Files->Learners->find('list', $learnerConditions)->all();

        $this->Authorization->authorize($file);
        $this->set(compact('file', 'fileTypes', 'users', 'learners'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        $this->Authorization->authorize($file);

        $filePath = WWW_ROOT . $file->file_dir . DS . $file->filename;

        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            $this->Flash->warning(__('The actual file was not found on the server, but its reference will be deleted.'));
        }

        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private static function isValidUUID($uuid) {
        return preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $uuid);
    }
}
