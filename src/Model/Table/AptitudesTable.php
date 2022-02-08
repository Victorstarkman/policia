<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Aptitudes Model
 *
 * @property \App\Model\Table\PreoccupationalsTable&\Cake\ORM\Association\HasMany $Preoccupationals
 *
 * @method \App\Model\Entity\Aptitude newEmptyEntity()
 * @method \App\Model\Entity\Aptitude newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Aptitude[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aptitude get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aptitude findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Aptitude patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aptitude[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aptitude|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aptitude saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aptitude[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Aptitude[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Aptitude[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Aptitude[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AptitudesTable extends Table
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

        $this->setTable('aptitudes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Preoccupationals', [
            'foreignKey' => 'aptitude_id',
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
            ->maxLength('name', 150)
            ->allowEmptyString('name');

        return $validator;
    }
}
