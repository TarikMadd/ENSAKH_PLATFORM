<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
