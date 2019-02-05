<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paimentsupps Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Comptes
 * @property \Cake\ORM\Association\BelongsTo $Ordrevirments
 *
 * @method \App\Model\Entity\Paimentsupp get($primaryKey, $options = [])
 * @method \App\Model\Entity\Paimentsupp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Paimentsupp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paimentsupp|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paimentsupp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Paimentsupp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paimentsupp findOrCreate($search, callable $callback = null, $options = [])
 */
class PaimentsuppsTable extends Table
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

        $this->table('paimentsupps');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Comptes', [
            'foreignKey' => 'compte_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ordrevirments', [
            'foreignKey' => 'ordrevirment_id'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->date('datepaiment')
            ->requirePresence('datepaiment', 'create')
            ->notEmpty('datepaiment');

        $validator
            ->requirePresence('etatsomme', 'create')
            ->notEmpty('etatsomme');

        $validator
            ->requirePresence('ordrepaiment', 'create')
            ->notEmpty('ordrepaiment');

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
        $rules->add($rules->existsIn(['compte_id'], 'Comptes'));
        $rules->add($rules->existsIn(['ordrevirment_id'], 'Ordrevirments'));

        return $rules;
    }
}
