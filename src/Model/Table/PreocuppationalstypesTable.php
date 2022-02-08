<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Preocuppationalstypes Model
 *
 * @method \App\Model\Entity\Preocuppationalstype newEmptyEntity()
 * @method \App\Model\Entity\Preocuppationalstype newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Preocuppationalstype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Preocuppationalstype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Preocuppationalstype[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Preocuppationalstype|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Preocuppationalstype[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PreocuppationalstypesTable extends Table
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

        $this->setTable('preocuppationalstypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        return $validator;
    }
}
