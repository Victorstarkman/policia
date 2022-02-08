<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;

/**
 * Preocuppationalstypes Controller
 *
 * @property \App\Model\Table\PreocuppationalstypesTable $Preocuppationalstypes
 * @method \App\Model\Entity\Preocuppationalstype[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PreocuppationalstypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $preocuppationalstypes = $this->paginate($this->Preocuppationalstypes);

        $this->set(compact('preocuppationalstypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Preocuppationalstype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $preocuppationalstype = $this->Preocuppationalstypes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('preocuppationalstype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $preocuppationalstype = $this->Preocuppationalstypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $preocuppationalstype = $this->Preocuppationalstypes->patchEntity($preocuppationalstype, $this->request->getData());
            if ($this->Preocuppationalstypes->save($preocuppationalstype)) {
                $this->Flash->success(__('The preocuppationalstype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The preocuppationalstype could not be saved. Please, try again.'));
        }
        $this->set(compact('preocuppationalstype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Preocuppationalstype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $preocuppationalstype = $this->Preocuppationalstypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $preocuppationalstype = $this->Preocuppationalstypes->patchEntity($preocuppationalstype, $this->request->getData());
            if ($this->Preocuppationalstypes->save($preocuppationalstype)) {
                $this->Flash->success(__('The preocuppationalstype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The preocuppationalstype could not be saved. Please, try again.'));
        }
        $this->set(compact('preocuppationalstype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Preocuppationalstype id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $preocuppationalstype = $this->Preocuppationalstypes->get($id);
        if ($this->Preocuppationalstypes->delete($preocuppationalstype)) {
            $this->Flash->success(__('The preocuppationalstype has been deleted.'));
        } else {
            $this->Flash->error(__('The preocuppationalstype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
