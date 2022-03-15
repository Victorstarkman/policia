<?php
declare(strict_types=1);

namespace App\Controller\CentroMedico;

use App\Controller\AppController;
use App\Model\Table\PreoccupationalsTable;
use Cake\Http\Exception\UnauthorizedException;

/**
 * Preoccupationals Controller
 *
 * @property \App\Model\Table\PreoccupationalsTable $Preoccupationals
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PreoccupationalsController extends AppController
{


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
            'contain' => [
				'Candidates'
            ],
        ]);
		if ($preoccupational->isPresent()) {
			$this->Flash->success(__('No se pueden subir mas documentos al aspirante.'));
			return $this->redirect('centro-medico/preocupacionales/ver/' . $preoccupational->candidate_id);
		}

		if (!$preoccupational->appointment->isToday() and !$preoccupational->waitingResults()) {
			throw new UnauthorizedException('No tiene turno para hoy.');
		}

        if ($this->request->is(['patch', 'post', 'put'])) {
			if ($this->request->getData('status') == PreoccupationalsTable::WAITING) {
				if ($this->Preoccupationals->waiting($preoccupational)) {
					$this->Flash->success(__('Marcado como presente.'));
				} else {
					$this->Flash->error(__('Ups, hubo un problema y no se pudo marcar como presente. Intente nuevamente.'));
				}
			} elseif ($this->request->getData('status') == PreoccupationalsTable::PRESENT) {
				if ($this->Preoccupationals->present($preoccupational)) {
					$this->Flash->success(__('Marcado como finalizado.'));
					return $this->redirect('/centro-medico/preocupacionales/ver/' . $preoccupational->candidate_id);
				} else {
					$this->Flash->error(__('Ups, hubo un problema y no se pudo marcar como finalizado. Intente nuevamente.'));
				}
			}
        }
	    $present = PreoccupationalsTable::PRESENT;
	    $waiting = PreoccupationalsTable::WAITING;
        $this->set(compact('preoccupational', 'present', 'waiting'));
    }

	public function view($candidateID = null)
	{
		$candidate = $this->Preoccupationals->Candidates->get($candidateID, [
			'contain' => [
				'Users',
				'Preoccupationals' => [
					'Preocuppationalstypes',
					'Aptitudes',
					'Files'
				]
			],
		]);

		if (!empty($candidate->preoccupationals)) {
			if (!$candidate->preoccupationals[count($candidate->preoccupationals) - 1]->isPresent()) {
				return $this->redirect('centro-medico/preocupacionales/presente/' . $candidate->id);
			}
		} else {
			return $this->redirect('centro-medico/');
		}

		$this->set(compact('candidate'));
	}


	public function markAsAbsent($id)
	{
		$this->request->allowMethod(['post', 'delete']);
		$preoccupationCandidate = $this->Preoccupationals->get($id);
		if ($this->Preoccupationals->absent($preoccupationCandidate)) {
			$this->Flash->success(__('El turno fue marcado como ausente.'));
		} else {
			$this->Flash->error(__('Ups, hubo un problema al intentar modificar el turno. Intente nuevamente.'));
		}

		return $this->redirect('/centro-medico/');

	}


}
