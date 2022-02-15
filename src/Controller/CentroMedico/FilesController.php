<?php
declare(strict_types=1);

namespace App\Controller\CentroMedico;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Laminas\Diactoros\Exception\UploadedFileAlreadyMovedException;
use Cake\Routing\Router;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
	public function addFile($preoccupationID = null) {
		$this->viewBuilder()->setLayout('ajax');
		$ret['success'] = false;
		$receivedData = $this->request->getData();
		if (isset($receivedData['preoccupationFile']) && !empty($receivedData['preoccupationFile'])) {
			$attachment =$receivedData['preoccupationFile'];

			$data = [
				'preoccupational_id' => $preoccupationID,
				'name' => '',
				'type' => $attachment->getClientMediaType(),
			];

			$path = WWW_ROOT . 'files/';
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path);
			}
			$path .= $preoccupationID . '/';
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path);
			}
			if (!$this->Files->checkDocument($attachment->getClientFilename(), $preoccupationID)) {
				try {
					$this->loadComponent('Uploadfile');
					$uploadStatus = $this->Uploadfile->upload($attachment, $path);
				}catch (\Exception $e) {
					$uploadStatus['success'] = false;
				}
				if($uploadStatus['success']) {
					$file = $this->Files->newEmptyEntity();
					$data['name'] = $uploadStatus['filename'];
					$file = $this->Files->patchEntity($file, $data);

					if ($this->Files->save($file)) {
						$ret['name'] =  'ID-' . $file->id . '(' . $uploadStatus['ext'] . ')';
						$ret['success'] = true;
					} else {
						$ret['msg'] = 'Hubo un problema al guardar la imagen';
					}
				} else {
					$ret['msg'] = 'La imagen no se pudo subir o ya existe la imagen con el mismo nombre';
				}
			} else {
				$ret['msg'] = 'Ya existe la imagen con el mismo nombre';
			}

		}

		$this->set(compact('ret'));
	}

	public function profilePhoto($candidateID = null) {
		$this->viewBuilder()->setLayout('ajax');
		$ret['success'] = false;
		$receivedData = $this->request->getData();
		if (isset($receivedData['profilePhoto']) && !empty($receivedData['profilePhoto'])) {
			$attachment = $receivedData['profilePhoto'];

			$data = [
				'preoccupational_id' => $candidateID,
				'type' => $attachment->getClientMediaType(),
			];

			$path = WWW_ROOT . 'img/candidates/';
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path);
			}
			//echo  WWW_ROOT . 'img/candidates/';
			//exit();
			$path .= $candidateID . '/';
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path);
			}

			try {
				$this->loadComponent('Uploadfile');
				$uploadStatus = $this->Uploadfile->upload($attachment, $path);
			}catch (\Exception $e) {
				$uploadStatus['success'] = false;
			}

			if($uploadStatus['success']) {
				$candidate = $this->Files->Preoccupationals->Candidates->get($candidateID, [
					'contain' => [],
				]);
				$data['photo'] = $uploadStatus['filename'];

				$candidate = $this->Files->Preoccupationals->Candidates->patchEntity($candidate, $data);

				if ($this->Files->Preoccupationals->Candidates->save($candidate)) {
					$ret['name'] =  'ID-' . $candidate->id;
					$ret['success'] = true;
				} else {
					$ret['msg'] = 'Hubo un problema al guardar la imagen';
				}
			} else {
				$ret['msg'] = 'La imagen no se pudo subir o ya existe la imagen con el mismo nombre';
			}
		}

		$this->set(compact('ret'));
	}

	public function viewFiles($id = null, $type = "file")
	{
		$url = Router::url('/', true);
		$this->viewBuilder()->setLayout('ajax');
		$response = array();
		if ($type == 'file') {
			$files = $this->Files->find('all')
				->where(['preoccupational_id' => $id])
				->contain(['Preoccupationals'])
				->toArray();
			$output_dir =  'files' . DS;
			$output_full_path = WWW_ROOT . $output_dir;
			$this->loadComponent('Uploadfile');
			foreach($files as $file) {
				$details = array();
				$details['name'] =   'ID-' . $file->id . ' (' . pathinfo($file->name, PATHINFO_EXTENSION) . ')<br/>' . $file->name;
				if ($this->Uploadfile->isImage(pathinfo($file->name, PATHINFO_EXTENSION))) {
					$details['path'] =  $url . $output_dir . $file->preoccupational->id  . DS . $file->name;
					$details['absolutePath'] = $output_full_path  . $file->preoccupational->id . DS . $file->name;
				} else {
					$details['path'] = $url . $output_dir . pathinfo($file->name, PATHINFO_EXTENSION) . '.jpg';
					$details['absolutePath'] = $output_full_path  .  pathinfo($file->name, PATHINFO_EXTENSION) . '.jpg';
					if (!file_exists($details['absolutePath'])) {
						$details['path'] = $url . $output_dir . 'default.jpg';
						$details['absolutePath'] = $output_full_path  . 'default.jpg';
					}
				}

				if (file_exists($details['absolutePath'])) {
					$details['size'] = filesize( $details['absolutePath']);
				}
				$details['allSize'] = $this->Uploadfile->bringAllSize($details['path'], $details['absolutePath'], $file->name);
				$response[] = $details;
			}
		} elseif ($type == "candidate") {
			$candidatePhoto = $this->Files->Preoccupationals->Candidates->find()->select(['id', 'photo'])->where(['id' => $id])->first();
			if (!is_null($candidatePhoto->photo)) {
				$output_dir =  $url . 'img/candidates' . DS .  $candidatePhoto->id . DS;
				$details = [
					'name' => 'ID-' . $candidatePhoto->id . '<br/>' . $candidatePhoto->photo,
					'path' => $output_dir . $candidatePhoto->photo,
					'absolutePath' => WWW_ROOT . $output_dir . $candidatePhoto->photo
				];

				if (file_exists($details['absolutePath'])) {
					$details['size'] = filesize( $details['absolutePath']);
				}
				$response[] = $details;
			};
		}

		$this->set('response', $response);
	}

	public function delete($id = null)
	{
		$this->viewBuilder()->setLayout('ajax');
		$this->request->allowMethod(['post', 'delete']);
		$data = $this->request->getData();
		$response = __('Error al eliminar la imagen.');
		if(isset($data["op"]) && $data["op"] == "delete" && isset($data['name'])) {
			$id = str_replace('ID-', '', $data['name']);
			$photoExist = true;
			try {
				$photo = $this->Files->get((int) $id,[
					'contain' => [
						'Preoccupationals'
					]
				]);
			} catch (\Exception $e) {
				$photoExist = false;
				$response = __('La imagen no existe');
			}

			if ($photoExist) {
				$output_dir = 'files/';
				$pathToProperty = WWW_ROOT . $output_dir  . $photo->preoccupational->id . DS . $photo->name;
				if ($this->Files->delete($photo)) {
					$response = __('La imagen fue eliminada.');
					unlink($pathToProperty);
				}
			}
		}

		$this->set(compact('response'));
	}
}
