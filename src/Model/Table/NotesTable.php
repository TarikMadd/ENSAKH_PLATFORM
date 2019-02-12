<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Elements
 * @property \Cake\ORM\Association\BelongsTo $Etudiers
 * @property \Cake\ORM\Association\HasMany $Pvupdate
 *
 * @method \App\Model\Entity\Note get($primaryKey, $options = [])
 * @method \App\Model\Entity\Note newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Note[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Note|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Note patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Note[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Note findOrCreate($search, callable $callback = null, $options = [])
 */
class NotesTable extends Table
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

        $this->setTable('notes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Elements', [
            'foreignKey' => 'element_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Etudiers', [
            'foreignKey' => 'etudier_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Pvupdate', [
            'foreignKey' => 'note_id'
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
            ->numeric('note')
            ->allowEmpty('note');

        $validator
            ->numeric('note_ratt')
            ->allowEmpty('note_ratt');

        $validator
            ->integer('confirmed')
            ->allowEmpty('confirmed');

        $validator
            ->boolean('ratt_confirmed')
            ->requirePresence('ratt_confirmed', 'create')
            ->notEmpty('ratt_confirmed');

        $validator
            ->integer('saved')
            ->allowEmpty('saved');

        $validator
            ->boolean('ratt_saved')
            ->requirePresence('ratt_saved', 'create')
            ->notEmpty('ratt_saved');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

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
        $rules->add($rules->existsIn(['element_id'], 'Elements'));
        $rules->add($rules->existsIn(['etudier_id'], 'Etudiers'));

        return $rules;
    }
}
