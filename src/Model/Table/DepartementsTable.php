<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departements Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Profpermanents
 * @property \Cake\ORM\Association\BelongsToMany $ProfvacatairesController
 *
 * @method \App\Model\Entity\Departement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Departement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Departement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Departement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Departement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Departement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Departement findOrCreate($search, callable $callback = null, $options = [])
 */
class DepartementsTable extends Table
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

        $this->table('departements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Profpermanents', [
            'foreignKey' => 'departement_id',
            'targetForeignKey' => 'profpermanent_id',
            'joinTable' => 'profpermanents_departements'
        ]);
        $this->belongsToMany('ProfvacatairesController', [
            'foreignKey' => 'departement_id',
            'targetForeignKey' => 'vacataire_id',
            'joinTable' => 'vacataires_departements'
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('nom_departement', 'create')
            ->notEmpty('nom_departement');

        $validator
            ->integer('nb_filiere')
            ->requirePresence('nb_filiere', 'create')
            ->notEmpty('nb_filiere');

        $validator
            ->integer('refer_depart')
            ->requirePresence('refer_depart', 'create')
            ->notEmpty('refer_depart');

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
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
