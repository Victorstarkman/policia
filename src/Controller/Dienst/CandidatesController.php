<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;

/**
 * Candidates Controller
 *
 * @property \App\Model\Table\CandidatesTable $Candidates
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
				'Preoccupationals'
            ],
        ];
        $candidates = $this->paginate($this->Candidates);
        $this->set(compact('candidates'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => ['Users', 'Preoccupationals'],
        ]);

        $this->set(compact('candidate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidate = $this->Candidates->newEmptyEntity();
        if ($this->request->is('post')) {
        	$data = $this->request->getData();
        	$data['user_id'] = $this->Authentication->getIdentity()->id;
			$candidateExistence = $this->Candidates->checkExistence($data);
			if (!$candidateExistence['exists']) {
				$candidate = $this->Candidates->patchEntity($candidate, $data);
				if ($this->Candidates->save($candidate)) {
					$this->Flash->success(__('The candidate has been saved.'));

					return $this->redirect(strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id);
				}
				$this->Flash->error(__('The candidate could not be saved. Please, try again.'));
			}
	        $this->Flash->error($candidateExistence['error'], ['escape' => false]);
        }
        $users = $this->Candidates->Users->find('list', ['limit' => 200])->all();
        $genders = $this->Candidates->Users->getGendersList();
        $this->set(compact('candidate', 'users', 'genders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidate = $this->Candidates->patchEntity($candidate, $this->request->getData());
            if ($this->Candidates->save($candidate)) {
                $this->Flash->success(__('The candidate has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidate could not be saved. Please, try again.'));
        }
        $users = $this->Candidates->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('candidate', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidate = $this->Candidates->get($id);
        if ($this->Candidates->delete($candidate)) {
            $this->Flash->success(__('The candidate has been deleted.'));
        } else {
            $this->Flash->error(__('The candidate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
