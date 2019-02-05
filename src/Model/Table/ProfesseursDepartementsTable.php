<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfesseursDepartements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Professeurs
 * @property \Cake\ORM\Association\BelongsTo $Departements
 *
 * @method \App\Model\Entity\ProfesseursDepartement get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfesseursDepartement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfesseursDepartement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfesseursDepartement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfesseursDepartement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfesseursDepartement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfesseursDepartement findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfesseursDepartementsTable extends Table
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

        $this->table('professeurs_departements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Professeurs', [
            'foreignKey' => 'professeur_id',
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

        $validator
            ->date('Date_debut')
            ->requirePresence('Date_debut', 'create')
            ->notEmpty('Date_debut');

        $validator
            ->requirePresence('Poste_Filiere', 'create')
            ->notEmpty('Poste_Filiere');

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
        $rules->add($rules->existsIn(['professeur_id'], 'Professeurs'));
        $rules->add($rules->existsIn(['departement_id'], 'Departements'));

        return $rules;
    }
}
