<?php
declare(strict_types=1);

namespace App\Controller\Dienst;

use App\Controller\AppController;
use App\Model\Table\PreoccupationalsTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
	    $search = $this->request->getQuery('search');
        $this->paginate = [
            'contain' => [
				'Preoccupationals' => [
					'Preocuppationalstypes',
					'Aptitudes'
				]
            ],
        ];
		$candidates = $this->Candidates->find();						
		if (!empty($search)) {
			$coincide= preg_match('/@/',$search);
			if(!$coincide){
				$search=$this->Upper->getCuil($search);
			}
			$candidates->where(['OR' => ['cuil' => $search, 'email' => $search]]);
		}
		$settings= [
			'order'=>['created'=>'desc'],
			'limit'	=>10
		];
			
        $candidates = $this->paginate($candidates,$settings);
		/* debug($candidates);
		exit;	 */	
        $this->set(compact('candidates', 'search'));
    }

	public function toCheck()
	{
		$search = $this->request->getQuery('search');
		$candidatesToCheck = $this->Candidates->Preoccupationals->getToCheck($search);
		$candidatesToCheck = $this->paginate($candidatesToCheck);

		$this->set(compact('candidatesToCheck', 'search'));
	}
    /**
     * View method
     *
     * @param string|null $id Candidate id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidate = $this->Candidates->get($id, [
            'contain' => [
				'Users',
	            'Preoccupationals' => [
					'Preocuppationalstypes',
		            'Aptitudes',
		            'Files'
	            ]
            ],
        ]);

        $this->set(compact('candidate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidate = $this->Candidates->newEmptyEntity();
        if ($this->request->is('post')) {
        	$data = $this->request->getData();
			$cuil=$this->Upper->getCuil($data['cuil']);
			$data['cuil']=$cuil;
        	$data['user_id'] = $this->Authentication->getIdentity()->id;
			$candidateExistence = $this->Candidates->checkExistence($data);
			if (!$candidateExistence['exists']) {
				$candidate = $this->Candidates->patchEntity($candidate, $data);
				if ($this->Candidates->save($candidate)) {
					$this->Flash->success(__('El aspirante fue creado. Asigne Turno.'));

					return $this->redirect(DS . strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurno/' . $candidate->id);
				}
				$this->Flash->error(__('El aspirante no pudo ser creado.'));
			}
	        $this->Flash->error($candidateExistence['error'], ['escape' => false]);
        }
        $users = $this->Candidates->Users->find('list', ['limit' => 200])->all();
        $genders = $this->Candidates->Users->getGendersList();
        $this->set(compact('candidate', 'users', 'genders'));  
    }

	public function edit($id) {
		$candidate = $this->Candidates->get($id);

		if ($this->request->is('put') || $this->request->is('post')) {
			$data = $this->request->getData();
			$data['user_id'] = $this->Authentication->getIdentity()->id;
			$candidateExistence = $this->Candidates->checkExistence($data, $id);
			if (!$candidateExistence['exists']) {
				$candidate = $this->Candidates->patchEntity($candidate, $data);
				if ($this->Candidates->save($candidate)) {
					$this->Flash->success(__('El aspirante fue actualizado.'));
					return $this->redirect(DS . strtolower($this->request->getParam('prefix')) . '/aspirantes/editar/' . $candidate->id);
				}
				$this->Flash->error(__('El aspirante no pudo ser creado.'));
			}
			$this->Flash->error($candidateExistence['error'], ['escape' => false]);
		}
		$users = $this->Candidates->Users->find('list', ['limit' => 200])->all();
		$genders = $this->Candidates->Users->getGendersList();
		$this->set(compact('candidate', 'users', 'genders'));
	}

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$candidate = $this->Candidates->get($id,[
			'contain' => [
				'Preoccupationals'
			]
		]);
		if (empty($candidate->preoccupationals)) {
			if ($this->Candidates->delete($candidate)) {
				$this->Flash->success(__('El aspirante se elimino.'));
			} else {
				$this->Flash->error(__('El aspirante no pudo ser eliminado, intente nuevamente.'));
			}
		} else {
			$this->Flash->error(__('No se puede eliminar aspirantes con Preocupacionales activos.'));
		}

		return $this->redirect(['action' => 'index']);
	}
	public function excelphp(){
		if(isset( $_FILES['import_file']['name'])){
			$filename=$_FILES['import_file']['name'];
			$file_ext= pathinfo($filename,PATHINFO_EXTENSION);
			$allowed_files= array('xls','csv','xlsx');
			if(in_array($file_ext,$allowed_files)){
				$inputFileNamePath = $_FILES['import_file']['tmp_name'];
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
				$data= $spreadsheet->getActiveSheet()->toArray();
				for($i=9;$i<count($data)-1;$i++){
					if(isset($data[$i][1])){
						$cuil=$data[$i][1];
						$lastname=$data[$i][4];
						$name= $data[$i][6];
						$gender=$data[$i][8];
						$phone=$data[$i][10];
						$email=$data[$i][19];
						//query 
						$cuil=$this->Upper->getCuil($cuil);
						$genders = $this->Candidates->Users->getGendersList();
						$keyGender=intval(array_search($gender,$genders));
						$t= time();
						$created= date('Y-m-d H:m:s',$t);
						$name=isset($name)?$this->Upper->upper(trim($name)):'';
						$lastname=isset($lastname)?$this->Upper->upper(trim($lastname)):'';
						/* debug($cuil.' '.$lastname.' '.$name.' '.$keyGender.' '.$phone.' '.$email.' '.$created);
						exit; */
						$datacandidate= array('name'=>$name,'lastname'=>$lastname,'cuil'=>$cuil,'phone'=>$phone,'gender'=>$keyGender,'email'=>$email,'user_id'=>2);
						//------------------query de guardado--------------------------------
						$candidateExistence = $this->Candidates->checkExistence($datacandidate);
						if($candidateExistence['exists']){
							$this->Flash->error($candidateExistence['error'].' Su cuil es '.$datacandidate['cuil'].' y su mail '.$datacandidate['email']);
							continue;
						}
						$query= $this->Candidates->query();
						$query->insert(['name','lastname','cuil','phone','email','gender','created','modified','user_id'])
						->values([
							'name' => $name,
							'lastname' =>$lastname,
							'cuil'=>$cuil,
							'phone'=>$phone,
							'email'=>$email,
							'gender'=>$keyGender,
							'created'=>$created,
							'modified'=>$created,
							'user_id'=>2
	
						])
						->execute();
						if($query){
							$this->Flash->success(_('El archivo se actualizó; correctamente'));
						}else{
							$this->Flash->error(_('El archivo no se actualizó; correctamente'));
							}   
					}
				}//fin de for
			}//fin de in array	
			$this->redirect(['action' => 'index']);
			return;
		}//fin de isset files
		else{
			$this->redirect(['action' => 'index']);
		}
	}//fin de funcion
}//fin de clase
