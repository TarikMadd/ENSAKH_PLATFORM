<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actualites Model
 *
 * @method \App\Model\Entity\Actualite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Actualite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Actualite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Actualite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Actualite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Actualite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Actualite findOrCreate($search, callable $callback = null, $options = [])
 */
class ActualitesTable extends Table
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

        $this->table('actualites');
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
            ->requirePresence('titre', 'create')
            ->notEmpty('titre');

        $validator
            ->requirePresence('texte', 'create')
            ->notEmpty('texte');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->requirePresence('photo', 'create')
            ->notEmpty('photo');

        return $validator;
    }
}
