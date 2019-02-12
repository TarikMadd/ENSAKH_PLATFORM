<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Semestres Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Niveaux
 * @property \Cake\ORM\Association\HasMany $Enseigners
 * @property \Cake\ORM\Association\HasMany $PreinscriptionsInfos
 *
 * @method \App\Model\Entity\Semestre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Semestre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Semestre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Semestre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Semestre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Semestre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Semestre findOrCreate($search, callable $callback = null, $options = [])
 */
class SemestresTable extends Table
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

        $this->table('semestres');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Niveaux', [
            'foreignKey' => 'niveaux_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Enseigners', [
            'foreignKey' => 'semestre_id'
        ]);
        $this->hasMany('PreinscriptionsInfos', [
            'foreignKey' => 'semestre_id'
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

        return $rules;
    }
}
