<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VacatairesGrades Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Grades
 * @property \Cake\ORM\Association\BelongsTo $Vacataires
 *
 * @method \App\Model\Entity\VacatairesGrade get($primaryKey, $options = [])
 * @method \App\Model\Entity\VacatairesGrade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VacatairesGrade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VacatairesGrade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VacatairesGrade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VacatairesGrade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VacatairesGrade findOrCreate($search, callable $callback = null, $options = [])
 */
class VacatairesGradesTable extends Table
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

        $this->table('vacataires_grades');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Grades', [
            'foreignKey' => 'grade_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vacataires', [
            'foreignKey' => 'vacataire_id',
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
            ->date('datedebut')
            ->requirePresence('datedebut', 'create')
            ->notEmpty('datedebut');

        $validator
            ->date('datefin')
            ->requirePresence('datefin', 'create')
            ->notEmpty('datefin');

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
        $rules->add($rules->existsIn(['grade_id'], 'Grades'));
        $rules->add($rules->existsIn(['vacataire_id'], 'Vacataires'));

        return $rules;
    }
}
