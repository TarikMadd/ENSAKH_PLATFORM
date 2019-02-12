<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Professeurs Model
 *
 * @property \Cake\ORM\Association\HasMany $Documents
 * @property \Cake\ORM\Association\HasMany $Enseigners
 * @property \Cake\ORM\Association\HasMany $Missions
 * @property \Cake\ORM\Association\HasMany $SupHeures
 * @property \Cake\ORM\Association\BelongsToMany $Activites
 * @property \Cake\ORM\Association\BelongsToMany $Departements
 * @property \Cake\ORM\Association\BelongsToMany $Disciplines
 * @property \Cake\ORM\Association\BelongsToMany $Grades
 *
 * @method \App\Model\Entity\Professeur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Professeur newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Professeur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Professeur|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Professeur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Professeur[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Professeur findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfesseursTable extends Table
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

        $this->table('professeurs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Documents', [
            'foreignKey' => 'professeur_id'
        ]);
        $this->hasMany('Enseigners', [
            'foreignKey' => 'professeur_id'
        ]);
        $this->hasMany('Missions', [
            'foreignKey' => 'professeur_id'
        ]);
        $this->hasMany('SupHeures', [
            'foreignKey' => 'professeur_id'
        ]);
        $this->belongsToMany('Activites', [
            'foreignKey' => 'professeur_id',
            'targetForeignKey' => 'activite_id',
            'joinTable' => 'professeurs_activites'
        ]);
        $this->belongsToMany('Departements', [
            'foreignKey' => 'professeur_id',
            'targetForeignKey' => 'departement_id',
            'joinTable' => 'professeurs_departements'
        ]);
        $this->belongsToMany('Disciplines', [
            'foreignKey' => 'professeur_id',
            'targetForeignKey' => 'discipline_id',
            'joinTable' => 'professeurs_disciplines'
        ]);
        $this->belongsToMany('Grades', [
            'foreignKey' => 'professeur_id',
            'targetForeignKey' => 'grade_id',
            'joinTable' => 'professeurs_grades'
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
            ->requirePresence('poste', 'create')
            ->notEmpty('poste');

        $validator
            ->integer('echelle')
            ->requirePresence('echelle', 'create')
            ->notEmpty('echelle');

        $validator
            ->integer('echelon')
            ->requirePresence('echelon', 'create')
            ->notEmpty('echelon');

        $validator
            ->integer('etat')
            ->requirePresence('etat', 'create')
            ->notEmpty('etat');

        $validator
            ->dateTime('date_Recrut')
            ->requirePresence('date_Recrut', 'create')
            ->notEmpty('date_Recrut');

        $validator
            ->requirePresence('nom_prof', 'create')
            ->notEmpty('nom_prof');

        $validator
            ->requirePresence('prenom_prof', 'create')
            ->notEmpty('prenom_prof');

        $validator
            ->integer('age')
            ->requirePresence('age', 'create')
            ->notEmpty('age');

        $validator
            ->integer('nb_heures')
            ->requirePresence('nb_heures', 'create')
            ->notEmpty('nb_heures');

        $validator
            ->requirePresence('diplome', 'create')
            ->notEmpty('diplome');

        $validator
            ->requirePresence('specialite', 'create')
            ->notEmpty('specialite');

        $validator
            ->requirePresence('universite', 'create')
            ->notEmpty('universite');

        $validator
            ->requirePresence('autresdiplomes', 'create')
            ->notEmpty('autresdiplomes');

        $validator
            ->requirePresence('situation_familiale', 'create')
            ->notEmpty('situation_familiale');

        $validator
            ->integer('code_situation_admin')
            ->requirePresence('code_situation_admin', 'create')
            ->notEmpty('code_situation_admin');

        $validator
            ->date('dateNaissance')
            ->requirePresence('dateNaissance', 'create')
            ->notEmpty('dateNaissance');

        $validator
            ->integer('codeEtablissement')
            ->requirePresence('codeEtablissement', 'create')
            ->notEmpty('codeEtablissement');

        $validator
            ->requirePresence('Lieu_Naissance', 'create')
            ->notEmpty('Lieu_Naissance');

        $validator
            ->integer('CIN')
            ->requirePresence('CIN', 'create')
            ->notEmpty('CIN');

        return $validator;
    }
}
