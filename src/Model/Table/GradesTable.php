<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Grades Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Fonctionnaires
 * @property \Cake\ORM\Association\BelongsToMany $Profpermanents
 * @property \Cake\ORM\Association\BelongsToMany $Vacataires
 *
 * @method \App\Model\Entity\Grade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Grade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Grade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Grade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Grade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Grade findOrCreate($search, callable $callback = null, $options = [])
 */
class GradesTable extends Table
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

        $this->table('grades');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Fonctionnaires', [
            'foreignKey' => 'grade_id',
            'targetForeignKey' => 'fonctionnaire_id',
            'joinTable' => 'fonctionnaires_grades'
        ]);
        $this->belongsToMany('Profpermanents', [
            'foreignKey' => 'grade_id',
            'targetForeignKey' => 'profpermanent_id',
            'joinTable' => 'profpermanents_grades'
        ]);
        $this->belongsToMany('Vacataires', [
            'foreignKey' => 'grade_id',
            'targetForeignKey' => 'vacataire_id',
            'joinTable' => 'vacataires_grades'
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
            ->integer('codeGrade')
            ->requirePresence('codeGrade', 'create')
            ->notEmpty('codeGrade');

        $validator
            ->numeric('taux')
            ->requirePresence('taux', 'create')
            ->notEmpty('taux');

        $validator
            ->requirePresence('nomGrade', 'create')
            ->notEmpty('nomGrade');

        $validator
            ->requirePresence('categorie', 'create')
            ->notEmpty('categorie');

        return $validator;
    }
}
