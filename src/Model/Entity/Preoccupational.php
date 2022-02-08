<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Table\PreoccupationalsTable;
use Cake\ORM\Entity;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\TableRegistry;

/**
 * Preoccupational Entity
 *
 * @property int $id
 * @property int $candidate_id
 * @property \Cake\I18n\FrozenTime|null $appointment
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $status
 * @property int $aptitude_id
 * @property int $preocuppationalsType_id
 *
 * @property \App\Model\Entity\Candidate $candidate
 * @property \App\Model\Entity\Aptitude $aptitude
 * @property \App\Model\Entity\PreocuppationalsType $preocuppationals_type
 * @property \App\Model\Entity\File[] $files
 */
class Preoccupational extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'candidate_id' => true,
        'appointment' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'aptitude_id' => true,
        'preocuppationalsType_id' => true,
        'candidate' => true,
        'aptitude' => true,
        'preocuppationals_type' => true,
        'files' => true,
    ];

	public function noNeedForNewDate() {
		$PreoccupationalsTable = TableRegistry::get('Preoccupationals');
		return !in_array($this->status, $PreoccupationalsTable->noNeedOtherDateStatus());
	}

	public function presentOrAbsent() {
		$text = false;
		if ($this->status == PreoccupationalsTable::PRESENT) {
			$text = "Presente";
		} elseif ($this->status == PreoccupationalsTable::ABSENT) {
			$text = "Ausente";
		}

		return $text;
	}

	public function showDate() {
		return $this->appointment->format('d/m/Y H:m');
	}
}
