<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;
use Cake\Routing\Router;

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

	public function assignDate($candidateID)
	{
		if (is_null($candidateID)) {
			return $this->redirect(strtolower($this->request->getParam('prefix')) . '/aspirantes');
		}
		$checkPreviousPreoccupationals = $this->Preoccupationals->checkPreviousPreoccupationals($candidateID);

		if ($checkPreviousPreoccupationals['exist']) {
			$this->Flash->error(__('El aspirante ya cuenta con un turno vigente'));
			return $this->redirect(strtolower($this->request->getParam('prefix')) . '/aspirantes');
		}
		$preoccupational = $this->Preoccupationals->newEmptyEntity();
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['candidate_id'] = $candidateID;
			$data['status'] = $this->Preoccupationals->activeStatus();
			$preoccupational = $this->Preoccupationals->patchEntity($preoccupational, $data);
			if ($this->Preoccupationals->save($preoccupational)) {
				$this->Flash->success(__('The preoccupational has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The preoccupational could not be saved. Please, try again.'));
		}
		$preocuppationalsTypes = $this->Preoccupationals->Preocuppationalstypes->find('list', ['limit' => 200])->all();
		$this->set(compact('preoccupational', 'candidateID', 'preocuppationalsTypes'));
	}

	public function assignDateMassive()
	{
		$candidatesWithoutDate = $this->Preoccupationals->Candidates->find('withoutAppoitment');
		$preocuppationalsTypes = $this->Preoccupationals->Preocuppationalstypes->find('list', ['limit' => 200])->all();
		$this->set(compact('candidatesWithoutDate', 'preocuppationalsTypes'));
	}


	public function addMasive() {
		$stringToReturn = "La consulta no es válida.";
		$error = true;
		if ($this->request->is('ajax')) {
			$params = $this->request->getQueryParams();
			$candidatesID = $params['candidatesID'];
			$dateToAssign = $params['date'];
			$preocuppationalstype_id = $params['preocuppationalstype_id'];
			$arrayOfInfo = [
				'quantities' => [
					'errors' => 0,
					'success' => 0,
					'alreadyWithAppointment' => 0,
					'total' => 0
				]
			];

			if (!empty($candidatesID) and !empty($dateToAssign) and !empty($preocuppationalstype_id)) {
				$error = false;
				foreach ($candidatesID as $candidateID) {
					$arrayOfInfo['quantities']['total']++;
					$checkPreviousPreoccupationals = $this->Preoccupationals->checkPreviousPreoccupationals($candidateID);
					if ($checkPreviousPreoccupationals['exist']) {
						$arrayOfInfo['quantities']['alreadyWithAppointment']++;
						continue;
					}
					$preoccupational = $this->Preoccupationals->newEmptyEntity();
					$data['candidate_id'] = $candidateID;
					$data['appointment'] = $dateToAssign;
					$data['preocuppationalsType_id'] = $preocuppationalstype_id;
					$data['status'] = $this->Preoccupationals->activeStatus();
					$preoccupational = $this->Preoccupationals->patchEntity($preoccupational, $data);
					if ($this->Preoccupationals->save($preoccupational)) {
						$arrayOfInfo['quantities']['success']++;
					} else {
						$arrayOfInfo['quantities']['errors']++;
					}
				}
				$stringToReturn = "Se leyeron " . $arrayOfInfo['quantities']['total'] . " registros.<br/>";
				$stringToReturn .= "Ya contaban con una fecha valida " . $arrayOfInfo['quantities']['alreadyWithAppointment'] . " registros.<br/>";
				$stringToReturn .= "Se asigno correctamente la fecha a " . $arrayOfInfo['quantities']['success'] . " registros.<br/>";
				$stringToReturn .= "No se le asignó una fecha a " . $arrayOfInfo['quantities']['errors'] . " registros.<br/>";
			} else {
				$stringToReturn = "No se actualizo ningun registro.";
			}
		}
		if ($error) {
			$this->Flash->error($stringToReturn, ['escape' => false]);
		} else {
			$this->Flash->info($stringToReturn, ['escape' => false]);
		}
		$this->set(compact('stringToReturn'));
	}
}
