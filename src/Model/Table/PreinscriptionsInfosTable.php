<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PreinscriptionsInfos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PreinscriptionsDiplomes
 * @property \Cake\ORM\Association\BelongsTo $PreinscriptionsEtablissements
 * @property \Cake\ORM\Association\BelongsTo $Preinscriptions
 * @property \Cake\ORM\Association\BelongsTo $Semestres
 *
 * @method \App\Model\Entity\PreinscriptionsInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\PreinscriptionsInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PreinscriptionsInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PreinscriptionsInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PreinscriptionsInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PreinscriptionsInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PreinscriptionsInfo findOrCreate($search, callable $callback = null, $options = [])
 */
class PreinscriptionsInfosTable extends Table
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

        $this->table('preinscriptions_infos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('PreinscriptionsDiplomes', [
            'foreignKey' => 'preinscriptions_diplome_id'
        ]);
        $this->belongsTo('PreinscriptionsEtablissements', [
            'foreignKey' => 'preinscriptions_etablissement_id'
        ]);
        $this->belongsTo('Preinscriptions', [
            'foreignKey' => 'preinscription_id'
        ]);
        $this->belongsTo('Semestres', [
            'foreignKey' => 'semestre_id',
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
            ->numeric('note')
            ->requirePresence('note', 'create')
            ->notEmpty('note');

        $validator
            ->requirePresence('mention', 'create')
            ->notEmpty('mention');

        $validator
            ->requirePresence('anneeObtention', 'create')
            ->notEmpty('anneeObtention');

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
        $rules->add($rules->existsIn(['preinscriptions_diplome_id'], 'PreinscriptionsDiplomes'));
        $rules->add($rules->existsIn(['preinscriptions_etablissement_id'], 'PreinscriptionsEtablissements'));
        $rules->add($rules->existsIn(['preinscription_id'], 'Preinscriptions'));
        $rules->add($rules->existsIn(['semestre_id'], 'Semestres'));

        return $rules;
    }
}
