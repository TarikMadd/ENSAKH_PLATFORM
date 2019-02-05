<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articleevents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Devisdemandes
 *
 * @method \App\Model\Entity\Articleevent get($primaryKey, $options = [])
 * @method \App\Model\Entity\Articleevent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Articleevent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Articleevent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Articleevent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Articleevent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Articleevent findOrCreate($search, callable $callback = null, $options = [])
 */
class ArticleeventsTable extends Table
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

        $this->table('articleevents');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Devisdemandes', [
            'foreignKey' => 'devisdemande_id'
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
            ->allowEmpty('desigantion');

        $validator
            ->integer('quantite')
            ->allowEmpty('quantite');

        $validator
            ->numeric('prix_unitaire_ht')
            ->allowEmpty('prix_unitaire_ht');

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
        $rules->add($rules->existsIn(['devisdemande_id'], 'Devisdemandes'));

        return $rules;
    }
}
