<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FonctionnairesDocuments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsTo $Documents
 *
 * @method \App\Model\Entity\FonctionnairesDocument get($primaryKey, $options = [])
 * @method \App\Model\Entity\FonctionnairesDocument newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FonctionnairesDocument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FonctionnairesDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesDocument findOrCreate($search, callable $callback = null, $options = [])
 */
class FonctionnairesDocumentsTable extends Table
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

        $this->table('fonctionnaires_documents');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fonctionnaires', [
            'foreignKey' => 'fonctionnaire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Documents', [
            'foreignKey' => 'document_id',
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
            ->dateTime('dateDemande')
            ->requirePresence('dateDemande', 'create')
            ->notEmpty('dateDemande');

        $validator
            ->requirePresence('etatdemande', 'create')
            ->notEmpty('etatdemande');

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
        $rules->add($rules->existsIn(['fonctionnaire_id'], 'Fonctionnaires'));
        $rules->add($rules->existsIn(['document_id'], 'Documents'));

        return $rules;
    }
}
