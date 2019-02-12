<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SupHeures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profpermanents
 * @property \Cake\ORM\Association\BelongsTo $Paimentsups
 *
 * @method \App\Model\Entity\SupHeure get($primaryKey, $options = [])
 * @method \App\Model\Entity\SupHeure newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SupHeure[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SupHeure|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SupHeure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SupHeure[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SupHeure findOrCreate($search, callable $callback = null, $options = [])
 */
class SupHeuresTable extends Table
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

        $this->table('sup_heures');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Profpermanents', [
            'foreignKey' => 'profpermanent_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Paimentsups', [
            'foreignKey' => 'paimentsup_id'
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
            ->integer('mois')
            ->requirePresence('mois', 'create')
            ->notEmpty('mois');

        $validator
            ->integer('annee')
            ->requirePresence('annee', 'create')
            ->notEmpty('annee');

        $validator
            ->integer('nbHeure')
            ->requirePresence('nbHeure', 'create')
            ->notEmpty('nbHeure');

        $validator
            ->dateTime('dateInsertion')
            ->requirePresence('dateInsertion', 'create')
            ->notEmpty('dateInsertion');

        $validator
            ->requirePresence('etat', 'create')
            ->notEmpty('etat');

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
        $rules->add($rules->existsIn(['paimentsup_id'], 'Paimentsups'));

        return $rules;
    }
}
