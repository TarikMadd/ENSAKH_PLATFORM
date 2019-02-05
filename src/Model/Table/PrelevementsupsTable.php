<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prelevementsups Model
 *
 * @property \Cake\ORM\Association\HasMany $Paimentsups
 *
 * @method \App\Model\Entity\Prelevementsup get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prelevementsup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prelevementsup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prelevementsup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prelevementsup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prelevementsup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prelevementsup findOrCreate($search, callable $callback = null, $options = [])
 */
class PrelevementsupsTable extends Table
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

        $this->table('prelevementsups');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Paimentsups', [
            'foreignKey' => 'prelevementsup_id'
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

        return $validator;
    }
}
