<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Preoccupationals Model
 *
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\BelongsTo $Candidates
 * @property \App\Model\Table\AptitudesTable&\Cake\ORM\Association\BelongsTo $Aptitudes
 * @property \App\Model\Table\PreocuppationalsTypesTable&\Cake\ORM\Association\BelongsTo $PreocuppationalsTypes
 * @property \App\Model\Table\FilesTable&\Cake\ORM\Association\HasMany $Files
 *
 * @method \App\Model\Entity\Preoccupational newEmptyEntity()
 * @method \App\Model\Entity\Preoccupational newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Preoccupational[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Preoccupational get($primaryKey, $options = [])
 * @method \App\Model\Entity\Preoccupational findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Preoccupational patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Preoccupational[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Preoccupational|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preoccupational saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preoccupational[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PreoccupationalsTable extends Table
{

	const ACTIVE = 1;
	const ABSENT = 2;
	const CANCELLED = 3;
	const PRESENT = 4;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('preoccupationals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Candidates', [
            'foreignKey' => 'candidate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Aptitudes', [
            'foreignKey' => 'aptitude_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Preocuppationalstypes', [
            'foreignKey' => 'preocuppationalsType_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Files', [
            'foreignKey' => 'preoccupational_id',
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
            ->dateTime('appointment')
            ->allowEmptyDateTime('appointment');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn('candidate_id', 'Candidates'), ['errorField' => 'candidate_id']);
        $rules->add($rules->existsIn('aptitude_id', 'Aptitudes'), ['errorField' => 'aptitude_id']);
        return $rules;
    }

	public function activeStatus() {
		return static::ACTIVE;
	}

	public function noNeedOtherDateStatus() {
		return [
			static::ACTIVE,
			static::PRESENT
		];
	}

	public function inactiveStatuses() {
		return [
			static::ABSENT,
			static::CANCELLED
		];
	}

	public function checkPreviousPreoccupationals($candidateID) {
		$previousPreoccupationals = [
			'exist' => false
		];

		$previousPreoccupationalsData = $this->find()->where(['candidate_id' => $candidateID])
			->where(['appointment > NOW()'])
			->where(['status NOT IN' => $this->inactiveStatuses()]);

		if ($previousPreoccupationalsData->count() > 1) {
			$previousPreoccupationals['exist'] = true;
		}

		return $previousPreoccupationals;
	}

	public function getThisDate($date) {
		return $appointmentForTheDate = $this->find()->where([
			'appointment >=' => $date->startOfDay(),
			'appointment <=' => $date->endOfDay(),
			'status NOT IN' => $this->inactiveStatuses()
			]);
	}



}
