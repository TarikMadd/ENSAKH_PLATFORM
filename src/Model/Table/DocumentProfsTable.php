<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocumentProfs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profs
 * @property \Cake\ORM\Association\BelongsTo $Documents
 *
 * @method \App\Model\Entity\DocumentProf get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocumentProf newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DocumentProf[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocumentProf|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocumentProf patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocumentProf[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocumentProf findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DocumentProfsTable extends Table
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

        $this->table('document_profs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Profs', [
            'foreignKey' => 'prof_id',
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
            ->requirePresence('etat', 'create')
            ->notEmpty('etat');

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
        $rules->add($rules->existsIn(['prof_id'], 'Profs'));
        $rules->add($rules->existsIn(['document_id'], 'Documents'));

        return $rules;
    }
}
