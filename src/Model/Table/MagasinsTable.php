<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
