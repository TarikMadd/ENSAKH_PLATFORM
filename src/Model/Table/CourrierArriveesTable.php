<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourrierArrivees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Expediteurs
 * @property \Cake\ORM\Association\BelongsTo $Services
 *
 * @method \App\Model\Entity\CourrierArrivee get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourrierArrivee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourrierArrivee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourrierArrivee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourrierArrivee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierArrivee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierArrivee findOrCreate($search, callable $callback = null, $options = [])
 */
class CourrierArriveesTable extends Table
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

        $this->table('courrier_arrivees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Expediteurs', [
            'foreignKey' => 'expediteur_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Services', [
            'foreignKey' => 'service_id'
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
            ->date('date_arrivee')
            ->requirePresence('date_arrivee', 'create')
            ->notEmpty('date_arrivee');

        $validator
            ->requirePresence('Désignation', 'create')
            ->notEmpty('Désignation');

        $validator
            ->requirePresence('type_courrier', 'create')
            ->notEmpty('type_courrier');

        $validator
            ->requirePresence('Priorité', 'create')
            ->notEmpty('Priorité');

        $validator
            ->date('date_limite_du_traitement')
            ->allowEmpty('date_limite_du_traitement');

        $validator
            ->requirePresence('etat_du_courrier', 'create')
            ->notEmpty('etat_du_courrier');

        $validator
            ->requirePresence('necessité_du_traitement', 'create')
            ->notEmpty('necessité_du_traitement');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('courrier', 'create')
            ->notEmpty('courrier');

        $validator
            ->requirePresence('accuse', 'create')
            ->notEmpty('accuse');

        $validator
            ->maxLength('courrier_retourne', 5)
            ->allowEmpty('courrier_retourne');

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
        $rules->add($rules->existsIn(['expediteur_id'], 'Expediteurs'));
        $rules->add($rules->existsIn(['service_id'], 'Services'));

        return $rules;
    }
}
