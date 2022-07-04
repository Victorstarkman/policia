<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

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
	public function replaceFile() {
		$this->viewBuilder()->setLayout('ajax');
		$response = ['data' => null, 'error' => true];
		$receivedData = $this->request->getData();
		try {
			if (!$this->request->is(['patch', 'post', 'put'])) { throw new \Exception('El request debe ser POST.'); }
			if (empty($receivedData['fileID'])) { throw new \Exception('El fileID no esta presente.');  }
			if (empty($receivedData['file-0'])) { throw new \Exception('La imagen no puede estar vacia.');  }
			$attachment = $receivedData['file-0'];
			$oldFile = $this->Files->get($receivedData['fileID']);
			if (empty($oldFile)) { throw new \Exception('El fileID no es correcto.');  }

			$path = WWW_ROOT . 'files/';
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path);
			}
			$path .= $oldFile->preoccupational_id . '/';
			if (!file_exists($path) && !is_dir($path)) {
				mkdir($path);
			}

			if ($this->Files->checkDocument($attachment->getClientFilename(), $oldFile->preoccupational_id, ['exclude_id' => $oldFile->id])) { throw new \Exception('Ya existe la imagen con el mismo nombre'); }
			try {
				$this->loadComponent('Uploadfile');
				$uploadStatus = $this->Uploadfile->upload($attachment, $path);
			} catch (\Exception $e) {
				throw new \Exception('No se pudo grabar el archivo.');
			}

			if(!$uploadStatus['success']) { throw new \Exception('La imagen no se pudo subir o ya existe la imagen con el mismo nombre'); }

			$data['name'] = $uploadStatus['filename'];
			$data['type'] = $attachment->getClientMediaType();
			$oldFile = $this->Files->patchEntity($oldFile, $data);

			if (!$this->Files->save($oldFile)) { throw new \Exception('Hubo un problema al guardar la imagen'); }

			$response = [
				'error' => 'false',
				'data' => [
					'id' => $oldFile->id,
					'preoccupational_id' => $oldFile->preoccupational_id,
				]
			];
		} catch (\Exception $e) {
			$response = [
				'error' => true,
				'message' => $e->getMessage(),
			];
		}

		$this->set(compact('response'));
	}

	public function viewFiles($preoccupationalID) {
		$this->viewBuilder()->setLayout('ajax');
		$files = $this->Files->find('all')->where(['preoccupational_id' => $preoccupationalID])->toArray();
		$this->set(compact('preoccupationalID', 'files'));
	}

	public function delete($id = null)
	{
		$this->viewBuilder()->setLayout('ajax');
		$this->request->allowMethod(['post', 'delete']);
		try {
			if (!$this->request->allowMethod(['post', 'delete'])) { throw new \Exception('El request debe ser POST o DELETE.'); }
			$data = $this->request->getData();
			if (empty($data["deleteID"]) ) {  throw new \Exception('ID no presente.');}
			$photo = $this->Files->get((int) $data["deleteID"],[
				'contain' => [
					'Preoccupationals'
				]
			]);
			if (empty($photo)) { throw new \Exception("Imagen no existe.");}
			$output_dir = 'files/';
			$pathToProperty = WWW_ROOT . $output_dir  . $photo->preoccupational->id . DS . $photo->name;
			$preoccupationID = $photo->preoccupational->id;
			if (!$this->Files->delete($photo)) { throw new \Exception("Se presento un problema al eliminar la imagen."); }
			unlink($pathToProperty);
			$response = [
				'error' => false,
				'data' => [
					'id' => $data["deleteID"],
					'preoccupational_id' => $preoccupationID,
				]
			];

		} catch (\Exception $e) {
			$response = [
				'error' => true,
				'message' => $e->getMessage(),
			];
		}
		$this->set(compact('response'));
	}

}
