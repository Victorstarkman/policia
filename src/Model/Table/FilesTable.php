<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Files Model
 *
 * @property \App\Model\Table\PreoccupationalsTable&\Cake\ORM\Association\BelongsTo $Preoccupationals
 *
 * @method \App\Model\Entity\File newEmptyEntity()
 * @method \App\Model\Entity\File newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\File|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FilesTable extends Table
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

        $this->setTable('files');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Preoccupationals', [
            'foreignKey' => 'preoccupational_id',
            'joinType' => 'INNER',
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
            ->scalar('type')
            ->maxLength('type', 45)
            ->allowEmptyString('type');

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
        $rules->add($rules->existsIn('preoccupational_id', 'Preoccupationals'), ['errorField' => 'preoccupational_id']);

        return $rules;
    }

	public function checkDocument($filename, $preocupationalID, $extraParams = []) {

		$countOfFiles = $this->find()->where(['name' => $filename, 'preoccupational_id' => $preocupationalID]);
		if ($extraParams['exclude_id']) {
			$countOfFiles->where(['id NOT IN' => $extraParams['exclude_id']]);
		}

		$countOfFiles = $countOfFiles->all()->count();
		return $countOfFiles > 0;
	}
}
