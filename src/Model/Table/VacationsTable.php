<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vacations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vacataires
 * @property \Cake\ORM\Association\BelongsTo $Paimentvacs
 *
 * @method \App\Model\Entity\Vacation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vacation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vacation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vacation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vacation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vacation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vacation findOrCreate($search, callable $callback = null, $options = [])
 */
class VacationsTable extends Table
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

        $this->table('vacations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Vacataires', [
            'foreignKey' => 'vacataire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Paimentvacs', [
            'foreignKey' => 'paimentvac_id'
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
        $rules->add($rules->existsIn(['vacataire_id'], 'Vacataires'));
        $rules->add($rules->existsIn(['paimentvac_id'], 'Paimentvacs'));

        return $rules;
    }
}
