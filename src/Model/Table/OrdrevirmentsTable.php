<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordrevirments Model
 *
 * @property \Cake\ORM\Association\HasMany $Paimentvacs
 *
 * @method \App\Model\Entity\Ordrevirment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ordrevirment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ordrevirment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ordrevirment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordrevirment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ordrevirment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ordrevirment findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdrevirmentsTable extends Table
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

        $this->table('ordrevirments');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Paimentvacs', [
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
            ->date('datevairement')
            ->requirePresence('datevairement', 'create')
            ->notEmpty('datevairement');

        $validator
            ->requirePresence('lien', 'create')
            ->notEmpty('lien');

        $validator
            ->allowEmpty('commentaire');

        return $validator;
    }
}
