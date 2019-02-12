<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NotesAuth Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profpermanents
 *
 * @method \App\Model\Entity\NotesAuth get($primaryKey, $options = [])
 * @method \App\Model\Entity\NotesAuth newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NotesAuth[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NotesAuth|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NotesAuth patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NotesAuth[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NotesAuth findOrCreate($search, callable $callback = null, $options = [])
 */
class NotesAuthTable extends Table
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

        $this->setTable('notes_auth');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Profpermanents', [
            'foreignKey' => 'profpermanent_id',
            'joinType' => 'INNER'
        ]);
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
            ->requirePresence('key_module', 'create')
            ->notEmpty('key_module');

        $validator
            ->dateTime('date_valide')
            ->requirePresence('date_valide', 'create')
            ->notEmpty('date_valide');

        $validator
            ->boolean('for_ratt')
            ->requirePresence('for_ratt', 'create')
            ->notEmpty('for_ratt');

        $validator
            ->boolean('pv')
            ->requirePresence('pv', 'create')
            ->notEmpty('pv');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['profpermanent_id'], 'Profpermanents'));

        return $rules;
    }
}
