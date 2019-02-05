<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Profpermanentsbis Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Profpermanentsbi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Profpermanentsbi newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Profpermanentsbi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Profpermanentsbi|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Profpermanentsbi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Profpermanentsbi[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Profpermanentsbi findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfpermanentsbisTable extends Table
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

        $this->table('profpermanentsbis');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->numeric('salaire')
            ->requirePresence('salaire', 'create')
            ->notEmpty('salaire');

        $validator
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

        $validator
            ->requirePresence('email_prof', 'create')
            ->notEmpty('email_prof');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->integer('etat_attestation')
            ->allowEmpty('etat_attestation');

        $validator
            ->integer('etatdemande')
            ->allowEmpty('etatdemande');

        $validator
            ->requirePresence('photo', 'create')
            ->notEmpty('photo');

        $validator
            ->integer('etat_fichesalaire')
            ->requirePresence('etat_fichesalaire', 'create')
            ->notEmpty('etat_fichesalaire');

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
