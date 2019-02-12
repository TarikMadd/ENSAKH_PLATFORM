<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activites Model
 *
 * @property \Cake\ORM\Association\HasMany $Organisations
 * @property \Cake\ORM\Association\BelongsToMany $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsToMany $Professeurs
 * @property \Cake\ORM\Association\BelongsToMany $Vacataires
 *
 * @method \App\Model\Entity\Activite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Activite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activite findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivitesTable extends Table
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

        $this->table('activites');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Organisations', [
            'foreignKey' => 'activite_id'
        ]);
        $this->belongsToMany('Fonctionnaires', [
            'foreignKey' => 'activite_id',
            'targetForeignKey' => 'fonctionnaire_id',
            'joinTable' => 'fonctionnaires_activites'
        ]);
        $this->belongsToMany('Professeurs', [
            'foreignKey' => 'activite_id',
            'targetForeignKey' => 'professeur_id',
            'joinTable' => 'professeurs_activites'
        ]);
        $this->belongsToMany('Vacataires', [
            'foreignKey' => 'activite_id',
            'targetForeignKey' => 'vacataire_id',
            'joinTable' => 'vacataires_activites'
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
            ->requirePresence('nomActivite', 'create')
            ->notEmpty('nomActivite');

        $validator
            ->dateTime('dateDebut')
            ->requirePresence('dateDebut', 'create')
            ->notEmpty('dateDebut');

        $validator
            ->dateTime('dateFin')
            ->requirePresence('dateFin', 'create')
            ->notEmpty('dateFin');

        return $validator;
    }
}
