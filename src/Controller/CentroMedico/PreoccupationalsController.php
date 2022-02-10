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
		if (!$preoccupational->appointment->isToday()) {
			throw new UnauthorizedException('No tiene turno para hoy.');
		}

        if ($this->request->is(['patch', 'post', 'put'])) {
			if ($this->request->getData('status') == PreoccupationalsTable::PRESENT) {
				if ($this->Preoccupationals->present($preoccupational)) {
					$this->Flash->success(__('Marcado como presente.'));
				} else {
					$this->Flash->error(__('Ups, hubo un problema y no se pudo marcar como presente. Intente nuevamente.'));
				}
			}
        }
	    $present = PreoccupationalsTable::PRESENT;
        $this->set(compact('preoccupational', 'present'));
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
