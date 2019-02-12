<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Etudiants Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Etudiers
 * @property \Cake\ORM\Association\BelongsToMany $Certificats
 *
 * @method \App\Model\Entity\Etudiant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Etudiant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Etudiant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Etudiant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Etudiant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Etudiant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Etudiant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EtudiantsTable extends Table
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

        $this->table('etudiants');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Etudiers', [
            'foreignKey' => 'etudiant_id'
        ]);
        $this->belongsToMany('Certificats', [
            'foreignKey' => 'etudiant_id',
            'targetForeignKey' => 'certificat_id',
            'joinTable' => 'certificats_etudiants'
        ]);
        $this->addBehavior('Utils.Uploadable', [
              'photo' => [
                'field' => 'id',
                'path' => '{ROOT}{DS}{WEBROOT}{DS}img{DS}Etudiants{DS}',
                'fileName' => '{field}.{extension}',
                'filePath' => '{field}',
                'removeFileOnDelete' => true,
                'removeFileOnUpdate' => true
                ],
              
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
            ->allowEmpty('apogee')
            ->add('apogee', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('nom_fr');

        $validator
            ->allowEmpty('nom_ar');

        $validator
            ->allowEmpty('prenom_fr');

        $validator
            ->allowEmpty('prenom_ar');

        $validator
            ->integer('cne')
            ->allowEmpty('cne');

        $validator
            ->allowEmpty('cin');

        $validator
            ->date('date_naissance')
            ->allowEmpty('date_naissance');

        $validator
            ->allowEmpty('code_ville_naissance');

        $validator
            ->allowEmpty('ville_naissance_fr');

        $validator
            ->allowEmpty('ville_naissance_ar');

        $validator
            ->allowEmpty('code_pays_naissance');

        $validator
            ->allowEmpty('pays_naissance_fr');

        $validator
            ->allowEmpty('pays_naissance_ar');

        $validator
            ->allowEmpty('code_sexe');

        $validator
            ->allowEmpty('sexe_fr');

        $validator
            ->allowEmpty('sexe_ar');

        $validator
            ->allowEmpty('code_adresse_fix');

        $validator
            ->allowEmpty('adresse_fix_fr');

        $validator
            ->allowEmpty('adresse_fix_ar');

        $validator
            ->allowEmpty('adresse_annulle_fr');

        $validator
            ->allowEmpty('adresse_annulle_ar');

        $validator
            ->allowEmpty('annee_1er_inscription_universite');

        $validator
            ->allowEmpty('annee_1er_inscription_enseignement_superieur');

        $validator
            ->allowEmpty('annee_1er_inscription_universite_marocaine');

        $validator
            ->allowEmpty('code_bac');

        $validator
            ->allowEmpty('serie_bac_fr');

        $validator
            ->allowEmpty('serie_bac_ar');

        $validator
            ->allowEmpty('code_etablissement_bac');

        $validator
            ->allowEmpty('etablissement_bac_fr');

        $validator
            ->allowEmpty('etablissement_bac_ar');

        $validator
            ->allowEmpty('code_mention_bac');

        $validator
            ->allowEmpty('mention_bac');

        $validator
            ->allowEmpty('code_province_bac');

        $validator
            ->allowEmpty('province_bac_fr');

        $validator
            ->allowEmpty('province_bac_ar');

        $validator
            ->allowEmpty('annee_bac');

        $validator
            ->allowEmpty('code_type_handicap');

        $validator
            ->allowEmpty('type_handicap');

        $validator
            ->allowEmpty('code_type_hebergement');

        $validator
            ->allowEmpty('type_hebergement');

        $validator
            ->allowEmpty('code_situation_familiale');

        $validator
            ->allowEmpty('situation_familiale');

        $validator
            ->allowEmpty('situation_militaire');

        $validator
            ->allowEmpty('categorie_socio_professionnelle');

        $validator
            ->allowEmpty('domaine_activite_professionnelle');

        $validator
            ->allowEmpty('quatite_Travaillee');

        $validator
            ->allowEmpty('profession_pere_fr');

        $validator
            ->allowEmpty('profession_pere_ar');

        $validator
            ->allowEmpty('profession_mere_fr');

        $validator
            ->allowEmpty('profession_mere_ar');

        $validator
            ->allowEmpty('code_province_parents');

        $validator
            ->allowEmpty('province_parents_fr');

        $validator
            ->allowEmpty('province_parents_ar');

        $validator
            ->allowEmpty('annee_sortie');

        $validator
            ->allowEmpty('code_cite_universiatire');

        $validator
            ->allowEmpty('cite_universiatire');

        $validator
            ->integer('validi')
            ->allowEmpty('validi');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('numero_tel');

        $validator
            ->allowEmpty('email');



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
        $rules->add($rules->isUnique(['apogee']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}