<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
/**
 * Preoccupationals Controller
 *
 * @property \App\Model\Table\PreoccupationalsTable $Preoccupationals
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PreoccupationalsController extends AppController
{

	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['login']);
	}

	public function login()	{
		$this->request->allowMethod(['post']);
		$result = $this->Authentication->getResult();
		if ($result->isValid()) {
			$user = $result->getData();
			$payload = [
				'sub' => $user->id,
				'exp' => time() + 600,
			];

			$json = [
				'token' => JWT::encode($payload, Security::getSalt(), 'HS256'),
			];
		} else {
			$this->response = $this->response->withStatus(401);
			$json = [];
		}
		$this->set(compact('json'));
		$this->viewBuilder()->setOption('serialize', 'json');
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null|void Renders view
	 */
	public function index() {
		$this->request->allowMethod(['get']);
		$this->viewBuilder()->setLayout('ajax');
		$preoccupationals = $this->Preoccupationals->find()
			->contain(['Candidates', 'Preocuppationalstypes', 'Files', 'Aptitudes'])
			->where(['aptitude_id is not null']);
		$data = [];
		$key = 0;
		$actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		foreach($preoccupationals as $preoccupational) {
			$data[$key] =[
				'nombre' => $preoccupational->candidate->name,
				'apellido' => $preoccupational->candidate->lastname,
				'cuil' => $preoccupational->candidate->cuil,
				'telefono' => $preoccupational->candidate->phone,
				'email' => $preoccupational->candidate->email,
				'genero' => $preoccupational->candidate->getGender(),
				'foto_perfil' => $actualLink . '/img/candidates/' . $preoccupational->candidate->id . DS . $preoccupational->candidate->photo,
				'preocupacional' => [
					'turno' => $preoccupational->appointment->format('d/m/Y H:m'),
					'tipo' => $preoccupational->preocuppationalstype->name,
					'tieneObservaciones' => !empty($preoccupational->observations),
					'observaciones' => $preoccupational->observations,
					'estado' => $preoccupational->aptitude->name

				],
				'archivos' => []
			];

			foreach($preoccupational->files as $file) {
				$data[$key]['archivos'][] = [
					'nombre' => $file->name,
					'url' => $actualLink . $file->getUrl()
				];
			}
			$key++;
		}
		$json = ['data' => $data];
		$this->set(compact('json'));
		$this->viewBuilder()->setOption('serialize', 'json');
	}

	public function logout() {
		$json = [];

		$this->Authentication->logout();

		$this->set(compact('json'));
		$this->viewBuilder()->setOption('serialize', 'json');
	}
}
