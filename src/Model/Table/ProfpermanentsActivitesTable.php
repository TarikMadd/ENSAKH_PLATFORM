<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfpermanentsActivites Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profpermanents
 * @property \Cake\ORM\Association\BelongsTo $Activites
 *
 * @method \App\Model\Entity\ProfpermanentsActivite get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfpermanentsActivite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsActivite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsActivite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfpermanentsActivite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsActivite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsActivite findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfpermanentsActivitesTable extends Table
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

        $this->table('profpermanents_activites');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Profpermanents', [
            'foreignKey' => 'profpermanent_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Activites', [
            'foreignKey' => 'activite_id',
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
        $rules->add($rules->existsIn(['activite_id'], 'Activites'));

        return $rules;
    }
}
