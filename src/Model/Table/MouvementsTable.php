<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mouvements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Articles
  * @property \Cake\ORM\Association\BelongsTo $Magasins
 *
 * @method \App\Model\Entity\Mouvement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mouvement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mouvement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mouvement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mouvement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mouvement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mouvement findOrCreate($search, callable $callback = null, $options = [])
 */
class MouvementsTable extends Table
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

	
        $this->table('mouvements');
        $this->displayField('magasin_id');
        $this->primaryKey('id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('Magasins', [
            'foreignKey' => 'magasin_id',
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
            ->dateTime('date_mouvement')
            ->allowEmpty('date_mouvement');

        $validator
            ->allowEmpty('reference_entree');

        $validator
            ->allowEmpty('reference_sortie');

        $validator
            ->integer('quantite_entree')
            ->allowEmpty('quantite_entree');

        $validator
            ->integer('quantite_sortie')
            ->allowEmpty('quantite_sortie');

        $validator
            ->allowEmpty('service');

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
        $rules->add($rules->existsIn(['article_id'], 'Articles'));
		$rules->add($rules->existsIn(['magasin_id'], 'Magasins'));

        return $rules;
    }
}
