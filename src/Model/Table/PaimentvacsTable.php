<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paimentvacs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Prelevements
 * @property \Cake\ORM\Association\HasMany $Vacations
 *
 * @method \App\Model\Entity\Paimentvac get($primaryKey, $options = [])
 * @method \App\Model\Entity\Paimentvac newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Paimentvac[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paimentvac|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paimentvac patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Paimentvac[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paimentvac findOrCreate($search, callable $callback = null, $options = [])
 */
class PaimentvacsTable extends Table
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

        $this->table('paimentvacs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Prelevements', [
            'foreignKey' => 'prelevement_id'
        ]);
        $this->hasMany('Vacations', [
            'foreignKey' => 'paimentvac_id'
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
            ->date('dateDebut')
            ->requirePresence('dateDebut', 'create')
            ->notEmpty('dateDebut');

        $validator
            ->date('dateFin')
            ->requirePresence('dateFin', 'create')
            ->notEmpty('dateFin');

        $validator
            ->integer('Numero')
            ->allowEmpty('Numero');

        $validator
            ->allowEmpty('cheque');

        $validator
            ->numeric('montantBrut')
            ->allowEmpty('montantBrut');

        $validator
            ->numeric('Impot')
            ->allowEmpty('Impot');

        $validator
            ->numeric('MontantNet')
            ->allowEmpty('MontantNet');

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
        $rules->add($rules->existsIn(['prelevement_id'], 'Prelevements'));

        return $rules;
    }
}
