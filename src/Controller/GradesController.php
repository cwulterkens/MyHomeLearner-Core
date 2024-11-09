<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\ForbiddenException;

/**
 * Grades Controller
 *
 * @property \App\Model\Table\GradesTable $Grades
 * @method \App\Model\Entity\Grade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GradesController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'limit' => 10, // or another limit that suits your application
            // Add other pagination settings if necessary
        ];

        $grades = $this->paginate($this->Grades);

        // Assuming Authorization->authorize can throw an exception if not authorized,
        // you should handle it properly.
        try {
            foreach ($grades as $grade) {
                $this->Authorization->authorize($grade);
            }
        } catch (\Exception $e) {
            // Handle the exception, log it, set an error message, etc.
        }

        $this->set(compact('grades'));
    }

    public function view($id = null)
    {
        try {
            $grade = $this->Grades->get($id);
            $this->Authorization->authorize($grade);
        } catch (RecordNotFoundException $e) {
            // Handle the case when the grade is not found
            throw new NotFoundException(__('The grade could not be found.'));
        } catch (ForbiddenException $e) {
            // Handle the case when the user is not authorized to view the grade
            throw new ForbiddenException(__('You are not authorized to view this grade.'));
        }

        $this->set(compact('grade'));
    }

    public function add()
    {
        $grade = $this->Grades->newEmptyEntity();

        // Authorization check should be the first thing
        $this->Authorization->authorize($grade);

        if ($this->request->is('post')) {
            $grade = $this->Grades->patchEntity($grade, $this->request->getData());

            // It's good practice to check if the entity has any validation errors
            if ($grade->getErrors()) {
                // Handle validation errors, for example, by setting them to the session
                $this->Flash->error(__('Please correct the errors below.'));
            } else if ($this->Grades->save($grade)) {
                $this->Flash->success(__('The grade has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                // When save fails, and there are no validation errors, it might be due to other issues
                $this->Flash->error(__('The grade could not be saved. Please, try again.'));
            }
        }

        // If this is a GET request or the POST has failed, we set the entity to the view
        $this->set(compact('grade'));
    }

    public function edit($id = null)
    {
        try {
            $grade = $this->Grades->get($id);
            $this->Authorization->authorize($grade);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $grade = $this->Grades->patchEntity($grade, $this->request->getData());

                if ($grade->hasErrors()) {
                    $this->Flash->error(__('Please correct the errors below.'));
                } else if ($this->Grades->save($grade)) {
                    $this->Flash->success(__('The grade has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The grade could not be saved. Please, try again.'));
                }
            }
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('The grade could not be found.'));
            return $this->redirect(['action' => 'index']);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not authorized to edit this grade.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('grade'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        try {
            $grade = $this->Grades->get($id);
            $this->Authorization->authorize($grade);

            if ($this->Grades->delete($grade)) {
                $this->Flash->success(__('The grade has been deleted.'));
            } else {
                $this->Flash->error(__('The grade could not be deleted. Please, try again.'));
            }
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('The grade could not be found.'));
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not authorized to delete this grade.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
