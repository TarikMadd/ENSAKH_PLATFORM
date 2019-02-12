<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enseigners Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Semestres
 * @property \Cake\ORM\Association\BelongsTo $AnneeScolaires
 * @property \Cake\ORM\Association\BelongsTo $Elements
 * @property \Cake\ORM\Association\BelongsTo $Professeurs
 *
 * @method \App\Model\Entity\Enseigner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Enseigner newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Enseigner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Enseigner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enseigner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Enseigner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Enseigner findOrCreate($search, callable $callback = null, $options = [])
 */
class EnseignersTable extends Table
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

        $this->table('enseigners');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Semestres', [
            'foreignKey' => 'semestre_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AnneeScolaires', [
            'foreignKey' => 'annee_scolaire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Elements', [
            'foreignKey' => 'element_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Professeurs', [
            'foreignKey' => 'professeur_id',
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
        $rules->add($rules->existsIn(['semestre_id'], 'Semestres'));
        $rules->add($rules->existsIn(['annee_scolaire_id'], 'AnneeScolaires'));
        $rules->add($rules->existsIn(['element_id'], 'Elements'));
        $rules->add($rules->existsIn(['professeur_id'], 'Professeurs'));

        return $rules;
    }
}
