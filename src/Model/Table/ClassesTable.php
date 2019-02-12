<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Niveaux
 * @property \Cake\ORM\Association\BelongsTo $Filieres
 *
 * @method \App\Model\Entity\Class get($primaryKey, $options = [])
 * @method \App\Model\Entity\Class newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Class[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Class|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Class patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Class[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Class findOrCreate($search, callable $callback = null, $options = [])
 */
class ClassesTable extends Table
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

        $this->table('classes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Niveaux', [
            'foreignKey' => 'niveaux_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Filieres', [
            'foreignKey' => 'filiere_id',
            'joinType' => 'INNER'
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
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');

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
        $rules->add($rules->existsIn(['niveaux_id'], 'Niveaux'));
        $rules->add($rules->existsIn(['filiere_id'], 'Filieres'));

        return $rules;
    }
}
