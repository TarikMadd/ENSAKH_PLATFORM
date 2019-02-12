<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
        $this->hasMany('Commandes', [
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
            ->requirePresence('utilite', 'create')
            ->notEmpty('utilite');

        $validator
            ->integer('quantite')
            ->allowEmpty('quantite');

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

        return $rules;
    }
}
////////////////////////////////////////////////////////
/**
 * Commandes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Fournisseurs
 * @property \Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \App\Model\Entity\Commande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commande newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Commande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commande|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commande[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commande findOrCreate($search, callable $callback = null, $options = [])
 */
class CommandesTable extends Table
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

        $this->table('commandes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Fournisseurs', [
            'foreignKey' => 'fournisseur_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
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
            ->dateTime('cree')
            ->allowEmpty('cree');

        $validator
            ->integer('nbr_article')
            ->requirePresence('nbr_article', 'create')
            ->notEmpty('nbr_article');

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
        $rules->add($rules->existsIn(['fournisseur_id'], 'Fournisseurs'));
        $rules->add($rules->existsIn(['article_id'], 'Articles'));

        return $rules;
    }
}
////////////////////////////////////////////////////////////////////////
/**
 * Fournisseurs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $StockCategories
 * @property \Cake\ORM\Association\HasMany $Commandes
 *
 * @method \App\Model\Entity\Fournisseur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fournisseur newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fournisseur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fournisseur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fournisseur findOrCreate($search, callable $callback = null, $options = [])
 */
class FournisseursTable extends Table
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

        $this->table('fournisseurs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('StockCategories', [
            'foreignKey' => 'stock_categorie_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Commandes', [
            'foreignKey' => 'fournisseur_id'
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
            ->allowEmpty('nom_fournisseur');

        $validator
            ->allowEmpty('prenom_fournisseur');

        $validator
            ->allowEmpty('label_fournisseur');

        $validator
            ->allowEmpty('adresse');

        $validator
            ->email('email')
            ->allowEmpty('email');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['stock_categorie_id'], 'StockCategories'));

        return $rules;
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Magasins Model
 *
 * @property \Cake\ORM\Association\HasMany $Mouvements
 *
 * @method \App\Model\Entity\Magasin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Magasin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Magasin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Magasin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Magasin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Magasin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Magasin findOrCreate($search, callable $callback = null, $options = [])
 */
class MagasinsTable extends Table
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

        $this->table('magasins');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Mouvements', [
            'foreignKey' => 'magasin_id'
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
            ->allowEmpty('nom_magasin');

        return $validator;
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
**
 * Mouvements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Magasins
 * @property \Cake\ORM\Association\BelongsTo $Articles
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
        $this->primaryKey(['magasin_id', 'article_id']);

        $this->belongsTo('Magasins', [
            'foreignKey' => 'magasin_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
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
        $rules->add($rules->existsIn(['magasin_id'], 'Magasins'));
        $rules->add($rules->existsIn(['article_id'], 'Articles'));

        return $rules;
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * StockCategories Model
 *
 * @method \App\Model\Entity\StockCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class StockCategoriesTable extends Table
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

        $this->table('stock_categories');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('label_cat', 'create')
            ->notEmpty('label_cat');

        return $validator;
    }
}

