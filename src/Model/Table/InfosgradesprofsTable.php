<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Infosgradesprofs Model
 *
 * @method \App\Model\Entity\Infosgradesprof get($primaryKey, $options = [])
 * @method \App\Model\Entity\Infosgradesprof newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Infosgradesprof[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Infosgradesprof|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Infosgradesprof patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Infosgradesprof[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Infosgradesprof findOrCreate($search, callable $callback = null, $options = [])
 */
class InfosgradesprofsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('infosgradesprofs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('indice')
            ->requirePresence('indice', 'create')
            ->notEmpty('indice');

        $validator
            ->requirePresence('cadre', 'create')
            ->notEmpty('cadre');

        $validator
            ->requirePresence('grade', 'create')
            ->notEmpty('grade');

        $validator
            ->integer('echelon')
            ->requirePresence('echelon', 'create')
            ->notEmpty('echelon');

        return $validator;
    }
}
