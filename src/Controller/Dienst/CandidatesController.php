<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;
use App\Model\Table\PreoccupationalsTable;

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
	    $search = $this->request->getQuery('search');

        $this->paginate = [
            'contain' => [
				'Preoccupationals' => [
					'Preocuppationalstypes',
					'Aptitudes'
				]
            ],
        ];
		$candidates = $this->Candidates->find();
		if (!empty($search)) {
			$candidates->where(['OR' => ['cuil' => $search, 'email' => $search]]);
		}
        $candidates = $this->paginate($candidates);
        $this->set(compact('candidates', 'search'));
    }

	public function toCheck()
	{
		$search = $this->request->getQuery('search');
		$candidatesToCheck = $this->Candidates->Preoccupationals->getToCheck($search);
		$candidatesToCheck = $this->paginate($candidatesToCheck);

		$this->set(compact('candidatesToCheck', 'search'));
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
            'contain' => [
				'Users',
	            'Preoccupationals' => [
					'Preocuppationalstypes',
		            'Aptitudes',
		            'Files'
	            ]
            ],
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
}
