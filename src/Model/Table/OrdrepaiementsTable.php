<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordrepaiements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Devisdemandes
 *
 * @method \App\Model\Entity\Ordrepaiement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ordrepaiement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ordrepaiement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ordrepaiement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordrepaiement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ordrepaiement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ordrepaiement findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdrepaiementsTable extends Table
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

        $this->table('ordrepaiements');
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
            ->integer('identificateur_fiscale')
            ->allowEmpty('identificateur_fiscale');

        $validator
            ->integer('num_compte_fournisseur')
            ->allowEmpty('num_compte_fournisseur');

        $validator
            ->integer('num_compte_paiement')
            ->allowEmpty('num_compte_paiement');

        $validator
            ->integer('num_facture')
            ->allowEmpty('num_facture');

        $validator
            ->integer('exercice')
            ->allowEmpty('exercice');

        $validator
            ->dateTime('date')
            ->allowEmpty('date');

        $validator
            ->requirePresence('banque', 'create')
            ->notEmpty('banque');

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
