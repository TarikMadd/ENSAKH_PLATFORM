<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prelevements Model
 *
 * @property \Cake\ORM\Association\HasMany $Paimentvacs
 *
 * @method \App\Model\Entity\Prelevement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prelevement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prelevement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prelevement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prelevement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prelevement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prelevement findOrCreate($search, callable $callback = null, $options = [])
 */
class PrelevementsTable extends Table
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

        $this->table('prelevements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Paimentvacs', [
            'foreignKey' => 'prelevement_id'
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
