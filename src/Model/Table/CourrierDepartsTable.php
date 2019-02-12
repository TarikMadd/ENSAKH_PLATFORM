<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourrierDeparts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Destinataires
 *
 * @method \App\Model\Entity\CourrierDepart get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourrierDepart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourrierDepart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourrierDepart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepart findOrCreate($search, callable $callback = null, $options = [])
 */
class CourrierDepartsTable extends Table
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

        $this->setTable('courrier_departs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Destinataires', [
            'foreignKey' => 'destinataire_id',
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
            ->date('date_depart')
            ->requirePresence('date_depart', 'create')
            ->notEmpty('date_depart');

        $validator
            ->requirePresence('désignation', 'create')
            ->notEmpty('désignation');

        $validator
            ->requirePresence('type_courrier', 'create')
            ->notEmpty('type_courrier');

        $validator
            
            ->allowEmpty('service');

        $validator
            ->requirePresence('necessite', 'create')
            ->notEmpty('necessite');

        $validator
            ->requirePresence('etat_courrier', 'create')
            ->notEmpty('etat_courrier');

        $validator
            ->requirePresence('courrier', 'create')
            ->notEmpty('courrier');

        $validator
            ->requirePresence('accuse', 'create')
            ->notEmpty('accuse');

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
        $rules->add($rules->existsIn(['destinataire_id'], 'Destinataires'));

        return $rules;
    }
}
