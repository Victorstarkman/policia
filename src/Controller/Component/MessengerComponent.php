<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Mailer\Mailer;

class MessengerComponent extends Component
{
	private $transport = 'default';
	private $setFrom = [
		'email' => 'administracion@dienstpreos.com.ar',
		'name' => 'Turnos Preocupacionales'
	];
	private $testEmail = 'dev.administracion@dienstpreos.com.ar';

	public function initialize(array $config): void
	{
		parent::initialize($config);
		
	}

	private function sendEmail($to, $subject = 'Test',$template = 'default', $values = []) {
		$environment = Configure::read('environment');
		// Si no es prod, envia al test email.
		if ($environment != 'prod') {
			$to = $this->testEmail;
		}
	
		$bcc = [];
		if (is_array($to)) {
			$bcc = $to;
			$to = array_shift($bcc);
		}

		$mailer = new Mailer($this->transport);
		$mailer
			->setFrom([$this->setFrom['email'] => $this->setFrom['name']])
			->setTo($to);
			if (!empty($bcc)) {
				foreach ($bcc as $email) {
					$mailer->addBcc($email);
				}
			}
		$mailer
			->setSubject($subject)
			->setViewVars($values)
			->viewBuilder()
			->setTemplate($template);
		// Si es local, no hace el deliver.
		if ($environment != 'local') {
			$mailer->deliver();
		}

	}

	public function sentToCandidates($preocupational) {

		$candidates= $this->getController()->getTableLocator()->get('Candidates');
		$preocuppationalstypes = $this->getController()->getTableLocator()->get('Preocuppationalstypes');
		$candidate = $candidates->get($preocupational->candidate_id);
		$preocuppationalstype = $preocuppationalstypes->get($preocupational->preocuppationalsType_id);
		$to = $candidate['email'];
		$values = [
			'date' => $preocupational->appointment->i18nFormat('dd-MM-yyyy HH:mm'),
			'type' => $preocuppationalstype->name
		];
		$subject = 'TURNO ' . $values['date']. ' para examen Preocupacional a Cadetes/Bomberos Policia de la Ciudad';
		$template = 'cadetes';

		$this->sendEmail($to, $subject, $template, $values);
	}

	public function sentToCivil($user) {
		$candidates= $this->getController()->getTableLocator()->get('Candidates');
		$preocuppationalstypes = $this->getController()->getTableLocator()->get('Preocuppationalstypes');
		$candidate = $candidates->get($user->candidate_id);
		$preocuppationalstype = $preocuppationalstypes->get($user->preocuppationalsType_id);
		$to = $candidate['email'];
		$values = [
			'date' => $user->appointment->i18nFormat('dd-MM-yyyy HH:mm'),
			'type' => $preocuppationalstype->name
		];
		$subject = 'Turno '.$values['date'].' para examen Preocupacional Personal Civil  Policía de la Ciudad';
		$template = 'civil';
		$this->sendEmail($to, $subject, $template, $values);
	}
	public function sentToCenter($number=0,$date=null){
		$to= ["analia.zalazar@cmnogoya.com","policiadelaciudad@dienst.com.ar","melisa.paronetto@dienst.com.ar","jesicanunez@dienst.com.ar","barbara.sitjar@colonia-suiza.com"];
		//$to= ["victorstarkman@gmail.com"];
		$values =['count'=> $number, 'date'=> $date];
		$subject= "Turnos  para PREOS POLICIA";
		$template = 'centros';
		$this->sendEmail($to, $subject, $template, $values);
	}
}
