<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pvupdate Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profpermanents
 * @property \Cake\ORM\Association\BelongsTo $Notes
 *
 * @method \App\Model\Entity\Pvupdate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pvupdate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pvupdate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pvupdate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pvupdate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pvupdate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pvupdate findOrCreate($search, callable $callback = null, $options = [])
 */
class PvupdateTable extends Table
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

        $this->setTable('pvupdate');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Profpermanents', [
            'foreignKey' => 'profpermanent_id'
        ]);
        $this->belongsTo('Notes', [
            'foreignKey' => 'note_id',
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
            ->dateTime('date_update')
            ->requirePresence('date_update', 'create')
            ->notEmpty('date_update');

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
        $rules->add($rules->existsIn(['note_id'], 'Notes'));

        return $rules;
    }
}
