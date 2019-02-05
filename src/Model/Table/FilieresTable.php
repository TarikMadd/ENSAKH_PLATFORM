<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Filieres Model
 *
 * @property \Cake\ORM\Association\HasMany $Concours
 * @property \Cake\ORM\Association\HasMany $Groupes
 *
 * @method \App\Model\Entity\Filiere get($primaryKey, $options = [])
 * @method \App\Model\Entity\Filiere newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Filiere[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Filiere|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filiere patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Filiere[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Filiere findOrCreate($search, callable $callback = null, $options = [])
 */
class FilieresTable extends Table
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

        $this->table('filieres');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Concours', [
            'foreignKey' => 'filiere_id'
        ]);
        $this->hasMany('Groupes', [
            'foreignKey' => 'filiere_id'
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

        return $validator;
    }
}
