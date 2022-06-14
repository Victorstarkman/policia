<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;
use Cake\Routing\Router;
use Authentication\Identity;

/**
 * Preoccupationals Controller
 *
 * @property \App\Model\Table\PreoccupationalsTable $Preoccupationals
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PreoccupationalsController extends AppController
{

	public function modifyDate($candidateID) {

		if (is_null($candidateID)) {
			return $this->redirect(DS . strtolower($this->request->getParam('prefix')) . '/aspirantes');
		}

		$lastAppointment = $this->Preoccupationals->getLastAppointment($candidateID);
		if ($lastAppointment->readyForAptitud()) {
			$this->Flash->error(__('El turno del preocupacional no puede ser modificado'));
			return $this->redirect(DS .strtolower($this->request->getParam('prefix')) . '/aspirantes');
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->getData();
			$data['status'] = $this->Preoccupationals->activeStatus();
			$lastAppointment = $this->Preoccupationals->patchEntity($lastAppointment, $data);
			if ($this->Preoccupationals->save($lastAppointment)) {
				$this->Flash->success(__('Se le modifico el turno correctamente.'));
				return $this->redirect('/dienst/preocupacionales/ver/' . $candidateID);
			}
			$this->Flash->error(__('Upps, hubo un problema. Intente nuevamente.'));
		}
		$preocuppationalsTypes = $this->Preoccupationals->Preocuppationalstypes->find('list', ['limit' => 200])->all();
		$this->set(compact('lastAppointment', 'preocuppationalsTypes'));
	}

	public function assignDate($candidateID, $forzar = false)
	{

		if (is_null($candidateID)) {
			return $this->redirect(DS . strtolower($this->request->getParam('prefix')) . '/aspirantes');
		}

		if (!$forzar) {
			$checkPreviousPreoccupationals = $this->Preoccupationals->checkPreviousPreoccupationals($candidateID);

			if ($checkPreviousPreoccupationals['exist']) {
				$this->Flash->error(__('El aspirante ya cuenta con un turno vigente'));
				return $this->redirect(DS .strtolower($this->request->getParam('prefix')) . '/aspirantes');
			}
		}
		if(!is_null($candidateID)){
			$candidates= $this->getTableLocator()->get('Candidates');
			$candidate = $candidates->get($candidateID);
			$nombre_completo= $candidate['lastname'].' '.$candidate['name'];
		}
		
		$preoccupational = $this->Preoccupationals->newEmptyEntity();
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['candidate_id'] = $candidateID;
			$data['status'] = $this->Preoccupationals->activeStatus();
			$preoccupational = $this->Preoccupationals->patchEntity($preoccupational, $data);
			if ($this->Preoccupationals->save($preoccupational)) {
				$this->Flash->success(__('Se le asigno correctamente el turno.'));
				return $this->redirect('/dienst/aspirantes/');
			}
			$this->Flash->error(__('Upps, hubo un problema. Intente nuevamente.'));
		}
		$preocuppationalsTypes = $this->Preoccupationals->Preocuppationalstypes->find('list', ['limit' => 200])->all();
		$this->set(compact('preoccupational', 'candidateID', 'preocuppationalsTypes', 'forzar','nombre_completo'));
	}

	public function assignDateMassive()
	{
		$candidatesWithoutDate = $this->Preoccupationals->Candidates->find('withoutAppoitment')->order(['id'=>'DESC']);
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

	public function changeAptitud() {
		$auth = $this->Authentication->getIdentity();
		if ($this->request->is('post')) {
			if ($auth->group_id == 2) {
				$data = $this->request->getData();
				$preoccupational = $this->Preoccupationals->get($data['preoccupational_id']);
				if($data['aptitud']==="1") {
					$data['observations']='';
					$preoccupational->observations=$data['observations'];
				}
				$data['aptitud_id'] = $data['aptitud'];

				if ($this->Preoccupationals->needObservations($data['aptitud']) and empty($data['observations'])) {
					$this->Flash->error(__('Ups, faltaron las observaciones. Intente nuevamente.'));
				} else {
					$preoccupational->aptitude_id = $data['aptitud'];
					$preoccupational->observations = $data['observations'];
					$preoccupational->aptitude_by = $auth->id;
					if ($this->Preoccupationals->save($preoccupational)) {
						$this->Flash->success(__('Se grabo correctamente.'));
					} else {
						$this->Flash->error(__('Ups, hubo un problema al grabar, intente nuevamente.'));
					}
				}
			} else {
				$this->Flash->error(__('Ups, no tenes permisos.'));
			}
		}
		return $this->redirect(DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/ver/' . $preoccupational->candidate_id);
	}

	public function unsuscribe($candidateId=null)
    {
		$this->request->allowMethod(['get']);
		$preoccupationCandidate=$this->Preoccupationals->find()->where(['candidate_id'=> $candidateId])->order(['appointment'=>'DESC'])->first();
		$success=FALSE;

		if(!empty($preoccupationCandidate)){

			if ($this->Preoccupationals->unsubscribe($preoccupationCandidate)) {
				
				$success=TRUE;
			}
		}else{
			$preoccupational = $this->Preoccupationals->newEmptyEntity();
			  
				$data = [];
				$data['candidate_id'] = $candidateId;
				$data['preocuppationalsType_id'] = 1;
				$data['status'] = $this->Preoccupationals->unSubscribeStatus();
				$preoccupational = $this->Preoccupationals->patchEntity($preoccupational, $data);
				if ($this->Preoccupationals->save($preoccupational)) {
					$success=TRUE;
					
				}
				
		}
		if($success){
			$this->Flash->success(__('El aspirante fue marcado como baja.'));
		} else {
			$this->Flash->error(__('Ups, hubo un problema al intentar modificar el turno. Intente nuevamente.'));
		}
		return $this->redirect(DS . strtolower($this->request->getParam('prefix')) . '/aspirantes');
	}
}