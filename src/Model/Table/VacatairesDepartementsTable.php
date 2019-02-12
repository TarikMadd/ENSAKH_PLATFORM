<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VacatairesDepartements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vacataires
 * @property \Cake\ORM\Association\BelongsTo $Departements
 *
 * @method \App\Model\Entity\VacatairesDepartement get($primaryKey, $options = [])
 * @method \App\Model\Entity\VacatairesDepartement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VacatairesDepartement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VacatairesDepartement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VacatairesDepartement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VacatairesDepartement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VacatairesDepartement findOrCreate($search, callable $callback = null, $options = [])
 */
class VacatairesDepartementsTable extends Table
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

        $this->table('vacataires_departements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Vacataires', [
            'foreignKey' => 'vacataire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Departements', [
            'foreignKey' => 'departement_id',
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
        $rules->add($rules->existsIn(['vacataire_id'], 'Vacataires'));
        $rules->add($rules->existsIn(['departement_id'], 'Departements'));

        return $rules;
    }
}
