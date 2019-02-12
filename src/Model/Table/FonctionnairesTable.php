<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fonctionnaires Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Missions
 * @property \Cake\ORM\Association\BelongsToMany $Activites
 * @property \Cake\ORM\Association\BelongsToMany $Grades
 * @property \Cake\ORM\Association\BelongsToMany $Services
 *
 * @method \App\Model\Entity\Fonctionnaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fonctionnaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fonctionnaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fonctionnaire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fonctionnaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fonctionnaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fonctionnaire findOrCreate($search, callable $callback = null, $options = [])
 */
class FonctionnairesTable extends Table
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

        $this->table('fonctionnaires');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Missions', [
            'foreignKey' => 'fonctionnaire_id'
        ]);
        $this->belongsToMany('Activites', [
            'foreignKey' => 'fonctionnaire_id',
            'targetForeignKey' => 'activite_id',
            'joinTable' => 'fonctionnaires_activites'
        ]);
        $this->belongsToMany('Grades', [
            'foreignKey' => 'fonctionnaire_id',
            'targetForeignKey' => 'grade_id',
            'joinTable' => 'fonctionnaires_grades'
        ]);
        $this->belongsToMany('Services', [
            'foreignKey' => 'fonctionnaire_id',
            'targetForeignKey' => 'service_id',
            'joinTable' => 'fonctionnaires_services'
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
            ->integer('somme')
            ->requirePresence('somme', 'create')
            ->notEmpty('somme');

        $validator
            ->dateTime('date_Recrut')
            ->requirePresence('date_Recrut', 'create')
            ->notEmpty('date_Recrut');

        $validator
            ->integer('echelle')
            ->requirePresence('echelle', 'create')
            ->notEmpty('echelle');

        $validator
            ->integer('echelon')
            ->requirePresence('echelon', 'create')
            ->notEmpty('echelon');

        $validator
            ->numeric('salaire')
            ->requirePresence('salaire', 'create')
            ->notEmpty('salaire');

        $validator
            ->integer('etat')
            ->requirePresence('etat', 'create')
            ->notEmpty('etat');

        $validator
            ->requirePresence('nom_fct', 'create')
            ->notEmpty('nom_fct');

        $validator
            ->requirePresence('prenom_fct', 'create')
            ->notEmpty('prenom_fct');

        $validator
            ->date('dateNaissance')
            ->requirePresence('dateNaissance', 'create')
            ->notEmpty('dateNaissance');

        $validator
            ->requirePresence('lieuNaissance', 'create')
            ->notEmpty('lieuNaissance');

        $validator
            ->requirePresence('specialite', 'create')
            ->notEmpty('specialite');

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
