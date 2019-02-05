<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vacataires Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Vacations
 * @property \Cake\ORM\Association\BelongsToMany $Activites
 * @property \Cake\ORM\Association\BelongsToMany $Departements
 * @property \Cake\ORM\Association\BelongsToMany $Disciplines
 * @property \Cake\ORM\Association\BelongsToMany $Grades
 *
 * @method \App\Model\Entity\Vacataire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vacataire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vacataire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vacataire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vacataire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vacataire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vacataire findOrCreate($search, callable $callback = null, $options = [])
 */
class VacatairesTable extends Table
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

        $this->table('vacataires');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Vacations', [
            'foreignKey' => 'vacataire_id'
        ]);
        $this->belongsToMany('Activites', [
            'foreignKey' => 'vacataire_id',
            'targetForeignKey' => 'activite_id',
            'joinTable' => 'vacataires_activites'
        ]);
        $this->belongsToMany('Departements', [
            'foreignKey' => 'vacataire_id',
            'targetForeignKey' => 'departement_id',
            'joinTable' => 'vacataires_departements'
        ]);
        $this->belongsToMany('Disciplines', [
            'foreignKey' => 'vacataire_id',
            'targetForeignKey' => 'discipline_id',
            'joinTable' => 'vacataires_disciplines'
        ]);
        $this->belongsToMany('Grades', [
            'foreignKey' => 'vacataire_id',
            'targetForeignKey' => 'grade_id',
            'joinTable' => 'vacataires_grades'
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
