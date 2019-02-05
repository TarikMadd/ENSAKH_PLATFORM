<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Documents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Professeurs
 * @property \Cake\ORM\Association\BelongsTo $Vacataires
 * @property \Cake\ORM\Association\BelongsTo $Fonctionnaires
 *
 * @method \App\Model\Entity\Document get($primaryKey, $options = [])
 * @method \App\Model\Entity\Document newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Document[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Document|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Document patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Document[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Document findOrCreate($search, callable $callback = null, $options = [])
 */
class DocumentsTable extends Table
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

        $this->table('documents');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Professeurs', [
            'foreignKey' => 'professeur_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vacataires', [
            'foreignKey' => 'vacataire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Fonctionnaires', [
            'foreignKey' => 'fonctionnaire_id',
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
            ->integer('idDocument')
            ->requirePresence('idDocument', 'create')
            ->notEmpty('idDocument');

        $validator
            ->integer('nbDocument')
            ->requirePresence('nbDocument', 'create')
            ->notEmpty('nbDocument');

        $validator
            ->requirePresence('nomDocument', 'create')
            ->notEmpty('nomDocument');

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
        $rules->add($rules->existsIn(['vacataire_id'], 'Vacataires'));
        $rules->add($rules->existsIn(['fonctionnaire_id'], 'Fonctionnaires'));

        return $rules;
    }
}
