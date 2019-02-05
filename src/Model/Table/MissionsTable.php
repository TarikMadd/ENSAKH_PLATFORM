<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Missions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsTo $Profpermanents
 * @property \Cake\ORM\Association\BelongsTo $Villes
 *
 * @method \App\Model\Entity\Mission get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mission findOrCreate($search, callable $callback = null, $options = [])
 */
class MissionsTable extends Table
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

        $this->table('missions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fonctionnaires', [
            'foreignKey' => 'fonctionnaire_id'
        ]);
        $this->belongsTo('Profpermanents', [
            'foreignKey' => 'profpermanent_id'
        ]);
        $this->belongsTo('Villes', [
            'foreignKey' => 'ville_id',
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
            ->dateTime('date_depart')
            ->requirePresence('date_depart', 'create')
            ->notEmpty('date_depart');

        $validator
            ->dateTime('date_arrivee')
            ->requirePresence('date_arrivee', 'create')
            ->notEmpty('date_arrivee');

        $validator
            ->requirePresence('mode_transport', 'create')
            ->notEmpty('mode_transport');

        $validator
            ->integer('nbr_nuit')
            ->requirePresence('nbr_nuit', 'create')
            ->notEmpty('nbr_nuit');

        $validator
            ->integer('taux')
            ->requirePresence('taux', 'create')
            ->notEmpty('taux');

        $validator
            ->numeric('indemnite_kilometrique')
            ->requirePresence('indemnite_kilometrique', 'create')
            ->notEmpty('indemnite_kilometrique');

        $validator
            ->integer('indemnite_appliquee')
            ->requirePresence('indemnite_appliquee', 'create')
            ->notEmpty('indemnite_appliquee');

        $validator
            ->requirePresence('etat', 'create')
            ->notEmpty('etat');

        $validator
            ->numeric('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

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
        $rules->add($rules->existsIn(['fonctionnaire_id'], 'Fonctionnaires'));
        $rules->add($rules->existsIn(['profpermanent_id'], 'Profpermanents'));
        $rules->add($rules->existsIn(['ville_id'], 'Villes'));

        return $rules;
    }
}
