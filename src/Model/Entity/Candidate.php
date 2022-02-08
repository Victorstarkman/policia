<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidate Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $lastname
 * @property string|null $cuil
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $gender
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Preoccupational[] $preoccupationals
 */
class Candidate extends Entity
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
        'name' => true,
        'lastname' => true,
        'cuil' => true,
        'phone' => true,
        'email' => true,
        'gender' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'user' => true,
        'preoccupationals' => true,
    ];
}
