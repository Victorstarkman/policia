<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;

/**
 * Aptitudes Controller
 *
 * @property \App\Model\Table\AptitudesTable $Aptitudes
 * @method \App\Model\Entity\Aptitude[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AptitudesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $aptitudes = $this->paginate($this->Aptitudes);

        $this->set(compact('aptitudes'));
    }

    /**
     * View method
     *
     * @param string|null $id Aptitude id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aptitude = $this->Aptitudes->get($id, [
            'contain' => ['Preoccupationals'],
        ]);

        $this->set(compact('aptitude'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aptitude = $this->Aptitudes->newEmptyEntity();
        if ($this->request->is('post')) {
            $aptitude = $this->Aptitudes->patchEntity($aptitude, $this->request->getData());
            if ($this->Aptitudes->save($aptitude)) {
                $this->Flash->success(__('The aptitude has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aptitude could not be saved. Please, try again.'));
        }
        $this->set(compact('aptitude'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Aptitude id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $aptitude = $this->Aptitudes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $aptitude = $this->Aptitudes->patchEntity($aptitude, $this->request->getData());
            if ($this->Aptitudes->save($aptitude)) {
                $this->Flash->success(__('The aptitude has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The aptitude could not be saved. Please, try again.'));
        }
        $this->set(compact('aptitude'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Aptitude id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $aptitude = $this->Aptitudes->get($id);
        if ($this->Aptitudes->delete($aptitude)) {
            $this->Flash->success(__('The aptitude has been deleted.'));
        } else {
            $this->Flash->error(__('The aptitude could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
