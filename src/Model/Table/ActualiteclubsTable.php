<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actualiteclubs Model
 *
 * @method \App\Model\Entity\Actualiteclub get($primaryKey, $options = [])
 * @method \App\Model\Entity\Actualiteclub newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Actualiteclub[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Actualiteclub|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Actualiteclub patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Actualiteclub[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Actualiteclub findOrCreate($search, callable $callback = null, $options = [])
 */
class ActualiteclubsTable extends Table
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

        $this->table('actualiteclubs');
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->requirePresence('texte', 'create')
            ->notEmpty('texte');

        $validator
            ->integer('id_club')
            ->requirePresence('id_club', 'create')
            ->notEmpty('id_club');

        $validator
            ->allowEmpty('image');

        $validator
            ->allowEmpty('video');

        $validator
            ->requirePresence('fichier', 'create')
            ->notEmpty('fichier');

        return $validator;
    }
}
