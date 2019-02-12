<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FonctionnairesServices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsTo $Services
 *
 * @method \App\Model\Entity\FonctionnairesService get($primaryKey, $options = [])
 * @method \App\Model\Entity\FonctionnairesService newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FonctionnairesService[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesService|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FonctionnairesService patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesService[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesService findOrCreate($search, callable $callback = null, $options = [])
 */
class FonctionnairesServicesTable extends Table
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

        $this->table('fonctionnaires_services');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fonctionnaires', [
            'foreignKey' => 'fonctionnaire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Services', [
            'foreignKey' => 'service_id',
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
            ->dateTime('date_debut')
            ->requirePresence('date_debut', 'create')
            ->notEmpty('date_debut');

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
        $rules->add($rules->existsIn(['service_id'], 'Services'));

        return $rules;
    }
}
