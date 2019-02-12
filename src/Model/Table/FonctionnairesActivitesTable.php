<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FonctionnairesActivites Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsTo $Activites
 *
 * @method \App\Model\Entity\FonctionnairesActivite get($primaryKey, $options = [])
 * @method \App\Model\Entity\FonctionnairesActivite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FonctionnairesActivite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesActivite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FonctionnairesActivite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesActivite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesActivite findOrCreate($search, callable $callback = null, $options = [])
 */
class FonctionnairesActivitesTable extends Table
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

        $this->table('fonctionnaires_activites');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fonctionnaires', [
            'foreignKey' => 'fonctionnaire_id',
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

        $validator
            ->dateTime('date_organisation')
            ->requirePresence('date_organisation', 'create')
            ->notEmpty('date_organisation');

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
        $rules->add($rules->existsIn(['activite_id'], 'Activites'));

        return $rules;
    }
}
