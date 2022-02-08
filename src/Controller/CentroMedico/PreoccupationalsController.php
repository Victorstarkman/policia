<?php
declare(strict_types=1);

namespace App\Controller\CentroMedico;

use App\Controller\AppController;

/**
 * Preoccupationals Controller
 *
 * @property \App\Model\Table\PreoccupationalsTable $Preoccupationals
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PreoccupationalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Candidates', 'Aptitudes', 'Preocuppationalstypes'],
        ];
        $preoccupationals = $this->paginate($this->Preoccupationals);

        $this->set(compact('preoccupationals'));
    }

    /**
     * View method
     *
     * @param string|null $id Preoccupational id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $preoccupational = $this->Preoccupationals->get($id, [
            'contain' => ['Candidates', 'Aptitudes', 'Preocuppationalstypes', 'Files'],
        ]);

        $this->set(compact('preoccupational'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $preoccupational = $this->Preoccupationals->newEmptyEntity();
        if ($this->request->is('post')) {
            $preoccupational = $this->Preoccupationals->patchEntity($preoccupational, $this->request->getData());
            if ($this->Preoccupationals->save($preoccupational)) {
                $this->Flash->success(__('The preoccupational has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The preoccupational could not be saved. Please, try again.'));
        }
        $candidates = $this->Preoccupationals->Candidates->find('list', ['limit' => 200])->all();
        $aptitudes = $this->Preoccupationals->Aptitudes->find('list', ['limit' => 200])->all();
        $preocuppationalstypes = $this->Preoccupationals->Preocuppationalstypes->find('list', ['limit' => 200])->all();
        $this->set(compact('preoccupational', 'candidates', 'aptitudes', 'preocuppationalstypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Preoccupational id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $preoccupational = $this->Preoccupationals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $preoccupational = $this->Preoccupationals->patchEntity($preoccupational, $this->request->getData());
            if ($this->Preoccupationals->save($preoccupational)) {
                $this->Flash->success(__('The preoccupational has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The preoccupational could not be saved. Please, try again.'));
        }
        $candidates = $this->Preoccupationals->Candidates->find('list', ['limit' => 200])->all();
        $aptitudes = $this->Preoccupationals->Aptitudes->find('list', ['limit' => 200])->all();
        $preocuppationalstypes = $this->Preoccupationals->Preocuppationalstypes->find('list', ['limit' => 200])->all();
        $this->set(compact('preoccupational', 'candidates', 'aptitudes', 'preocuppationalstypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Preoccupational id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $preoccupational = $this->Preoccupationals->get($id);
        if ($this->Preoccupationals->delete($preoccupational)) {
            $this->Flash->success(__('The preoccupational has been deleted.'));
        } else {
            $this->Flash->error(__('The preoccupational could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
