<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnneeScolaires Model
 *
 * @property \Cake\ORM\Association\HasMany $Enseigners
 * @property \Cake\ORM\Association\HasMany $Etudiers
 *
 * @method \App\Model\Entity\AnneeScolaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\AnneeScolaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AnneeScolaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AnneeScolaire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AnneeScolaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AnneeScolaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AnneeScolaire findOrCreate($search, callable $callback = null, $options = [])
 */
class AnneeScolairesTable extends Table
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

        $this->table('annee_scolaires');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Enseigners', [
            'foreignKey' => 'annee_scolaire_id'
        ]);
        $this->hasMany('Etudiers', [
            'foreignKey' => 'annee_scolaire_id'
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
            ->allowEmpty('libile');

        $validator
            ->date('annee')
            ->requirePresence('annee', 'create')
            ->notEmpty('annee');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

        return $validator;
    }
}
