<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
