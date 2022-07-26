<?php
declare(strict_types=1);

namespace App\Controller;

use Authentication\Identity;
use Cake\Event\EventInterface;
use Cake\Http\Exception\UnauthorizedException;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
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
			$userID = $this->Authentication->getIdentity()->id;
			$data = $this->Preoccupationals->Candidates->Users->setGroupIdentity($userID);
			if ($data->groupIdentity['api_access']) {
				$user = $result->getData();
				$identity = new Identity($data);
				$this->Authentication->setIdentity($identity);
				$payload = [
					'user_id' => $user->id,
					'sub' => $user->id,
					'exp' => time() + 600,
				];
				$date = new FrozenTime($payload['exp']);
				$json = [
					'token' => JWT::encode($payload, Security::getSalt(), 'HS256'),
					'code' => 200,
					'expiration' => $date
				];
			} else {
				$this->response = $this->response->withStatus(401);
				$json = [
					'message' => 'No tenes permisos suficientes.',
					'code' => 401,
					"url" => "/api/login",
					"line" => 45,
				];
			}
		} else {
			$this->response = $this->response->withStatus(401);
			$json = [
				'message' => 'Error al conectarse a la api',
				'code' => 401,
				"url" => "/api/login",
				"line" => 54,
			];
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
		$json = [];
		$preoccupationals = $this->Preoccupationals->find()
			->contain(['Candidates', 'Preocuppationalstypes', 'Files', 'Aptitudes'])
			->where(['aptitude_id is not null']);
		$getFilter = $this->request->getQueryParams();
		$beginDate = null;
		$endDate = null;
		$filtros = [];
		if (isset($getFilter['begin_date'])) {
			$beginDate = new FrozenTime($getFilter['begin_date']);
			$filtros[] = [
				'begin_date' => $beginDate
			];
			$preoccupationals->where(['appointment >=' => $beginDate]);
		}

		if (isset($getFilter['end_date'])) {
			$endDate = new FrozenTime($getFilter['end_date']);
			$endDate = $endDate->endOfDay();
			$filtros[] = [
				'end_date' => $endDate
			];
			$preoccupationals->where(['appointment <=' => $endDate]);
		}

		if ((!is_null($beginDate) && !is_null($endDate))
			and $beginDate > $endDate) {
			$this->response = $this->response->withStatus(400);
			$json = [
				'message' => 'La fecha de inicio no puede ser mas grande que la de final',
				'code' => 400,
				"url" => "/api/preocupacionales",
				"line" => 94,
			];
		}
		if (empty($json)) {
			$json = [
				'registros_totales' => $preoccupationals->count(),
				'code' => 200,
				'url' => "/api/preocupacionales",
				'filtros' => $filtros,
				'data' => []
			];
			$key = 0;
			$actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
			foreach($preoccupationals as $preoccupational) {
				$json['data'][$key] = [
					'nombre' => $preoccupational->candidate->name,
					'apellido' => $preoccupational->candidate->lastname,
					'cuil' => $preoccupational->candidate->cuil,
					'telefono' => $preoccupational->candidate->phone,
					'email' => $preoccupational->candidate->email,
					'genero' => $preoccupational->candidate->getGender(),
					'foto_perfil' => $actualLink . 'policiabsas/img/candidates/' . $preoccupational->candidate->id . DS . $preoccupational->candidate->photo,
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
					$json['data'][$key]['archivos'][] = [
						'nombre' => $file->name,
						'url' => $actualLink . 'policiabsas/files/' . $preoccupational->candidate->id.'/'.$file->name
					];
				}
				$key++;
			}
		}
		$this->set(compact('json'));
		$this->viewBuilder()->setOption('serialize', 'json');
	}
}
