<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Boncommandes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Devisdemandes
 *
 * @method \App\Model\Entity\Boncommande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Boncommande newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Boncommande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Boncommande|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Boncommande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Boncommande[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Boncommande findOrCreate($search, callable $callback = null, $options = [])
 */
class BoncommandesTable extends Table
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

        $this->table('boncommandes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Devisdemandes', [
            'foreignKey' => 'devisdemande_id'
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
            ->integer('exercice')
            ->allowEmpty('exercice');

        $validator
            ->numeric('prix_total')
            ->allowEmpty('prix_total');

        $validator
            ->date('date')
            ->allowEmpty('date');

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
        $rules->add($rules->existsIn(['devisdemande_id'], 'Devisdemandes'));

        return $rules;
    }
}
