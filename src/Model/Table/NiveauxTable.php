<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Niveaux Model
 *
 * @property \Cake\ORM\Association\HasMany $Classes
 * @property \Cake\ORM\Association\HasMany $Concours
 * @property \Cake\ORM\Association\HasMany $Semestres
 *
 * @method \App\Model\Entity\Niveaux get($primaryKey, $options = [])
 * @method \App\Model\Entity\Niveaux newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Niveaux[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Niveaux|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Niveaux patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Niveaux[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Niveaux findOrCreate($search, callable $callback = null, $options = [])
 */
class NiveauxTable extends Table
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

        $this->table('niveaux');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Classes', [
            'foreignKey' => 'niveaux_id'
        ]);
        $this->hasMany('Concours', [
            'foreignKey' => 'niveaux_id'
        ]);
        $this->hasMany('Semestres', [
            'foreignKey' => 'niveaux_id'
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
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

        return $validator;
    }
}
