<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FonctionnairesGrades Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsTo $Grades
 *
 * @method \App\Model\Entity\FonctionnairesGrade get($primaryKey, $options = [])
 * @method \App\Model\Entity\FonctionnairesGrade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FonctionnairesGrade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesGrade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FonctionnairesGrade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesGrade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FonctionnairesGrade findOrCreate($search, callable $callback = null, $options = [])
 */
class FonctionnairesGradesTable extends Table
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

        $this->table('fonctionnaires_grades');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fonctionnaires', [
            'foreignKey' => 'fonctionnaire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Grades', [
            'foreignKey' => 'grade_id',
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
            ->dateTime('date_prise')
            ->requirePresence('date_prise', 'create')
            ->notEmpty('date_prise');

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
        $rules->add($rules->existsIn(['fonctionnaire_id'], 'Fonctionnaires'));
        $rules->add($rules->existsIn(['grade_id'], 'Grades'));

        return $rules;
    }
}
