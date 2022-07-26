<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Routing\Router;

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
		$this->Authentication->addUnauthenticatedActions(['index']);
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
	    $this->viewBuilder()->setLayout('ajax');
		$preoccupationals = $this->Preoccupationals->find()
			->contain(['Candidates', 'Preocuppationalstypes', 'Files', 'Aptitudes'])
			->where(['aptitude_id is not null']);
	    $data = [];
		$key = 0;
	    $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		$actualdir=   isset($_SERVER['PHP_SELF'])?'/'.explode('/',$_SERVER['PHP_SELF'])[1]:'';
	    foreach($preoccupationals as $preoccupational) {
			$json['data'][$key] = [
				'nombre' => $preoccupational->candidate->name,
				'apellido' => $preoccupational->candidate->lastname,
				'cuil' => $preoccupational->candidate->cuil,
				'telefono' => $preoccupational->candidate->phone,
				'email' => $preoccupational->candidate->email,
				'genero' => $preoccupational->candidate->getGender(),
				'foto_perfil' => $actualLink . $actualdir.'/img/candidates/' . $preoccupational->candidate->id . DS . $preoccupational->candidate->photo,
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
					'url' => $actualLink . $actualdir.'/files/' . $preoccupational->candidate->id.'/'.$file->name
				];
			}
			$key++;
		}
	    $this->set(compact('data'));
    }

}
