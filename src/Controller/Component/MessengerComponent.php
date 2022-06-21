<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Mailer;

class MessengerComponent extends Component
{
	private $transport = 'default';
	private $setFrom = ['email' => 'administracion@dienstpreos.com.ar', 'name' => 'Turnos Preocupacionales'];
	public function initialize(array $config): void
	{
		parent::initialize($config);
	}

	private function sendEmail($to, $subject = 'Test',$template = 'default', $values = []) {
		$mailer = new Mailer($this->transport);
		$mailer
			->setFrom([$this->setFrom['email'] => $this->setFrom['name']])
			->setTo($to)
			->setSubject($subject)
			->viewBuilder()
			->setTemplate($template)
			->setViewVars($values);

		$mailer->deliver();
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
		$subject = 'TURNO ' . $values['date']. ' para examen Preocupacional a ' . $values['type'] .' de la Ciudad';
		$template = 'cadetes';

		$this->sendEmail($to, $subject, $template, $values);
	}

	public function sentToCivil($user) {
		$subject = 'Turno LUNES 23-05 08:00HS. para examen Preocupacional PERSONAL CIVIL ADMINISTRATIVO Policía de la Ciudad';
		$template = 'civil';
		$to = '';
		$this->sendEmail($to, $subject, $template, $values);
	}
}
