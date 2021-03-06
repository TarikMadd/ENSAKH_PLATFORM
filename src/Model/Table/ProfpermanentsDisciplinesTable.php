<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfpermanentsDisciplines Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profpermanents
 * @property \Cake\ORM\Association\BelongsTo $Disciplines
 *
 * @method \App\Model\Entity\ProfpermanentsDiscipline get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfpermanentsDiscipline newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsDiscipline[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsDiscipline|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfpermanentsDiscipline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsDiscipline[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfpermanentsDiscipline findOrCreate($search, callable $callback = null, $options = [])
 */
class ProfpermanentsDisciplinesTable extends Table
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

        $this->table('profpermanents_disciplines');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Profpermanents', [
            'foreignKey' => 'profpermanent_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Disciplines', [
            'foreignKey' => 'discipline_id',
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
        $rules->add($rules->existsIn(['profpermanent_id'], 'Profpermanents'));
        $rules->add($rules->existsIn(['discipline_id'], 'Disciplines'));

        return $rules;
    }
}
