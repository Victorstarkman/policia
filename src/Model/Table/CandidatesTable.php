<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidates Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PreoccupationalsTable&\Cake\ORM\Association\HasMany $Preoccupationals
 *
 * @method \App\Model\Entity\Candidate newEmptyEntity()
 * @method \App\Model\Entity\Candidate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Candidate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Candidate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Candidate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Candidate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Candidate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Candidate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CandidatesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('candidates');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Preoccupationals', [
            'foreignKey' => 'candidate_id',
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
            ->allowEmptyString('name');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 250)
            ->allowEmptyString('lastname');

        $validator
            ->scalar('cuil')
            ->maxLength('cuil', 45)
            ->allowEmptyString('cuil');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 45)
            ->allowEmptyString('phone');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->integer('gender')
            ->allowEmptyString('gender');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

	public function findWithoutAppoitment(Query $query, array $options)
	{
		$candidatesWithAppoitment = $this->Preoccupationals->find()->select(['candidate_id'])
			->where(['OR' => ['OR' => ['appointment > NOW()', 'appointment IS NULL'], 'status NOT IN' => $this->Preoccupationals->statusNotNeedNewMassiveDate()]]);

		$candidatesWithAppoitmentID = [];

		foreach ($candidatesWithAppoitment as $candidateWithAppoitment) {
			$candidatesWithAppoitmentID[$candidateWithAppoitment->candidate_id] = $candidateWithAppoitment->candidate_id;
		}

		if (!empty($candidatesWithAppoitmentID)) {
			$query->where(['id not in' => $candidatesWithAppoitmentID]);
		}

		return $query;
	}

	public function checkExistence($data, $id = null) {
		$userExistence = [
			'exists' => false,
			'candidate_id' => null,
			'error' => ''
		];
		$userExistenceData = $this->find()
							->select(['id', 'cuil', 'email'])
							->where(['OR' => ['cuil' => $data['cuil'], 'email' => $data['email']]]);
		if (!is_null($id)) {
			$userExistenceData->where(['id !=' => $id]);
		}
		$userExistenceData->first();
		if ($userExistenceData->count() > 0) {
			$userExistence['exists'] = true;
			$userExistenceData = $userExistenceData->first();
			$userExistence['candidate_id'] = $userExistenceData->id;
			if ($userExistenceData->cuil == $data['cuil']) {
				$userExistence['error'] = "Existe aspirante con el mismo cuil.";
			}

			if ($userExistenceData->email == $data['email']) {
				$userExistence['error'] .= "Existe aspirante con el mismo email.";
			}
		}

		return $userExistence;
	}
}
