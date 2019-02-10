<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

/**
 * Articles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $StockCategories
 * @property \Cake\ORM\Association\HasMany $Commandes
 * @property \Cake\ORM\Association\HasMany $Mouvements
 *
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, callable $callback = null, $options = [])
 */
class ArticlesTable extends Table
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

        $this->table('articles');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('StockCategories', [
            'foreignKey' => 'stock_categorie_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Commande_articles', [
            'foreignKey' => 'article_id'
        ]);
        $this->hasMany('Mouvements', [
            'foreignKey' => 'article_id'
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
            ->allowEmpty('label_article');
           
        $validator
            ->integer('quantite_min')
            ->allowEmpty('quantite_min');

        $validator
            ->allowEmpty('marque');

        $validator
            ->boolean('utilite')
            ->allowEmpty('utilite');

        $validator
            ->integer('quantite')
            ->allowEmpty('quantite');
        
        $validator 
            ->dateTime('date_article')
            ->allowEmpty('date_article');
    
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
        $rules->add($rules->existsIn(['stock_categorie_id'], 'StockCategories'));
        $rules->add($rules->isUnique(array('label_article')));
        return $rules;
    }
	

}
