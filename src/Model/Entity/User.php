<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Table\UsersTable;
use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $password
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property int|null $group
 *
 * @property \App\Model\Entity\Candidate[] $candidates
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'group_id' => true,
        'candidates' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

	protected function _setPassword(string $password) : ?string
	{
		if (strlen($password) > 0) {
			return (new DefaultPasswordHasher())->hash($password);
		}
	}

	public function groupName() {
		return UsersTable::GROUPS[$this->group_id]['name'];
	}
}
