<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Laureats Model
 *
 * @method \App\Model\Entity\Laureat get($primaryKey, $options = [])
 * @method \App\Model\Entity\Laureat newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Laureat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Laureat|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Laureat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Laureat[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Laureat findOrCreate($search, callable $callback = null, $options = [])
 */
class LaureatsTable extends Table
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

        $this->table('laureats');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('annee', 'create')
            ->notEmpty('annee');

        $validator
            ->integer('nombresTravailles')
            ->requirePresence('nombresTravailles', 'create')
            ->notEmpty('nombresTravailles');

        $validator
            ->integer('nombresNonTravailles')
            ->requirePresence('nombresNonTravailles', 'create')
            ->notEmpty('nombresNonTravailles');

        $validator
            ->requirePresence('filieres', 'create')
            ->notEmpty('filieres');

        return $validator;
    }
}
