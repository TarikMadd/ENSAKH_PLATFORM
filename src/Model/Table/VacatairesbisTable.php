<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vacatairesbis Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Vacatairesbi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vacatairesbi newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vacatairesbi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vacatairesbi|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vacatairesbi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vacatairesbi[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vacatairesbi findOrCreate($search, callable $callback = null, $options = [])
 */
class VacatairesbisTable extends Table
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

        $this->setTable('vacatairesbis');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('somme', 'create')
            ->notEmpty('somme');

        $validator
            ->requirePresence('nom_vacataire', 'create')
            ->notEmpty('nom_vacataire');

        $validator
            ->requirePresence('prenom_vacataire', 'create')
            ->notEmpty('prenom_vacataire');

        $validator
            ->integer('nb_heures')
            ->requirePresence('nb_heures', 'create')
            ->notEmpty('nb_heures');

        $validator
            ->integer('echelle')
            ->requirePresence('echelle', 'create')
            ->notEmpty('echelle');

        $validator
            ->integer('echelon')
            ->requirePresence('echelon', 'create')
            ->notEmpty('echelon');

        $validator
            ->dateTime('dateRecrut')
            ->requirePresence('dateRecrut', 'create')
            ->notEmpty('dateRecrut');

        $validator
            ->date('dateNaissance')
            ->requirePresence('dateNaissance', 'create')
            ->notEmpty('dateNaissance');

        $validator
            ->requirePresence('LieuNaissance', 'create')
            ->notEmpty('LieuNaissance');

        $validator
            ->requirePresence('diplome', 'create')
            ->notEmpty('diplome');

        $validator
            ->requirePresence('universite', 'create')
            ->notEmpty('universite');

        $validator
            ->requirePresence('specialite', 'create')
            ->notEmpty('specialite');

        $validator
            ->requirePresence('CIN', 'create')
            ->notEmpty('CIN');

        $validator
            ->requirePresence('situationFamiliale', 'create')
            ->notEmpty('situationFamiliale');

        $validator
            ->requirePresence('codeSituation', 'create')
            ->notEmpty('codeSituation');

        $validator
            ->date('dateAffectation')
            ->requirePresence('dateAffectation', 'create')
            ->notEmpty('dateAffectation');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
