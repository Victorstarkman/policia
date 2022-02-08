<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\HasMany $Candidates
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

	const GROUPS = [
		1 => [
			'name' => 'Admin',
			'redirect' => '/admin/usuarios',
			'prefix' => 'Admin'
		],
		2 => [
			'name' => 'Dienst',
			'redirect' => '/dienst/',
			'prefix' => 'Dienst'
		],
		3 => [
			'name' => 'Centro médico',
			'redirect' => '/centro-medico/',
			'prefix' => 'CentroMedico'
		]
	];

	const GENDERS = [
		1 => 'Masculino',
		2 => 'Femenino',
		3 => 'Otro'
	];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
	    $this->addBehavior('Muffin/Trash.Trash');

        $this->hasMany('Candidates', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->notEmptyString('name');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 250)
            ->notEmptyString('lastname');

        $validator
            ->email('email')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 250)
            ->notEmptyString('password');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->integer('group_id')
            ->notEmptyString('group_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }

    public function setGroupIdentity($userID) {
	    $user = $this->find()->where(['id' => $userID])->first();
	    $user['groupIdentity'] = self::GROUPS[$user->group_id];
		return $user;
    }

    public function getGroupList() {
		$groupsToParse = self::GROUPS;
		$groups= [];
		foreach ($groupsToParse as $groupID => $groupToParse) {
			$groups[$groupID] = $groupToParse['name'];
		}

		return $groups;
    }

    public function getGendersList() {
		return self::GENDERS;
    }

}
