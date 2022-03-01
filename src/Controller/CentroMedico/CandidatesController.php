<?php
declare(strict_types=1);

namespace App\Controller\CentroMedico;

use App\Controller\AppController;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cassandra\Time;

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
            'contain' => ['Candidates'],
        ];
		$today = new FrozenTime();
		$search = $this->request->getQuery('search');
		$candidatesWithAppoitment = $this->Candidates->Preoccupationals->getThisDate($today, $search);
	    $candidatesWithAppoitment = $this->paginate($candidatesWithAppoitment);

        $this->set(compact('candidatesWithAppoitment', 'today', 'search'));
    }

	/**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function waitingDocumentation()
    {
        $this->paginate = [
            'contain' => ['Candidates'],
        ];
		$search = $this->request->getQuery('search');
		$candidatesWithDocumentation = $this->Candidates->Preoccupationals->waitingResults($search);
	    $candidatesWithDocumentation = $this->paginate($candidatesWithDocumentation);

        $this->set(compact('candidatesWithDocumentation', 'search'));
    }

}
