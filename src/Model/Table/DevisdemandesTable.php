<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Devisdemandes Model
 *
 * @property \Cake\ORM\Association\HasMany $Articleevents
 * @property \Cake\ORM\Association\HasMany $Boncommandes
 *
 * @method \App\Model\Entity\Devisdemande get($primaryKey, $options = [])
 * @method \App\Model\Entity\Devisdemande newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Devisdemande[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Devisdemande|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Devisdemande patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Devisdemande[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Devisdemande findOrCreate($search, callable $callback = null, $options = [])
 */
class DevisdemandesTable extends Table
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

        $this->table('devisdemandes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Articleevents', [
            'foreignKey' => 'devisdemande_id'
        ]);
        $this->hasMany('Boncommandes', [
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
            ->allowEmpty('nom_devis');

        $validator
            ->allowEmpty('nom_fournisseur');

        $validator
            ->allowEmpty('adresse_fournisseur');

        $validator
            ->allowEmpty('intitule');

        $validator
            ->boolean('etat')
            ->allowEmpty('etat');

        return $validator;
    }
}
