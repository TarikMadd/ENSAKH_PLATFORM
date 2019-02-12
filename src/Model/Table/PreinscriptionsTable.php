<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Preinscriptions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Concours
 * @property \Cake\ORM\Association\HasMany $PreinscriptionsInfos
 *
 * @method \App\Model\Entity\Preinscription get($primaryKey, $options = [])
 * @method \App\Model\Entity\Preinscription newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Preinscription[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Preinscription|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Preinscription patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Preinscription[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Preinscription findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PreinscriptionsTable extends Table
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

        $this->table('preinscriptions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Concours', [
            'foreignKey' => 'concour_id'
        ]);
        $this->hasMany('PreinscriptionsInfos', [
            'foreignKey' => 'preinscription_id'
        ]);
        $this->belongsToMany('Activitesdespreinscriptions', [
            'foreignKey' => 'preinscription_id',
            'targetForeignKey' => 'activitesdespreinscription_id',
            'joinTable' => 'activitesdespreinscriptions_preinscriptions'
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
            ->integer('preselection')
            ->allowEmpty('preselection');

        $validator
            ->integer('admis')
            ->allowEmpty('admis');

        $validator
            ->integer('listeAttente')
            ->allowEmpty('listeAttente');

        $validator
            ->allowEmpty('username');

        $validator
            ->allowEmpty('password');

        $validator
            ->allowEmpty('nom_fr');

        $validator
            ->allowEmpty('nom_ar');

        $validator
            ->allowEmpty('prenom_fr');

        $validator
            ->allowEmpty('prenom_ar');

        $validator
            ->allowEmpty('cne');

        $validator
            ->allowEmpty('cin');

        $validator
            ->date('date_naissance')
            ->allowEmpty('date_naissance');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('tel');

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
            ->allowEmpty('image');

        $validator
            ->allowEmpty('fichierNotes');
            
        $validator
            ->allowEmpty('annee_obtention_bac');

        $validator
            ->allowEmpty('serie_bac');

        $validator
            ->allowEmpty('etablissement_bac');    

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
            ->allowEmpty('quantite_Travaillee');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['concour_id'], 'Concours'));

        return $rules;
    }
}
