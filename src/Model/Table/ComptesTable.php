<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comptes Model
 *
 * @property \Cake\ORM\Association\HasMany $Paimentvacs
 *
 * @method \App\Model\Entity\Compte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Compte newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Compte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Compte|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Compte[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Compte findOrCreate($search, callable $callback = null, $options = [])
 */
class ComptesTable extends Table
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

        $this->table('comptes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Paimentvacs', [
            'foreignKey' => 'compte_id'
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
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        $validator
            ->requirePresence('descriptions', 'create')
            ->notEmpty('descriptions');

        return $validator;
    }
}
