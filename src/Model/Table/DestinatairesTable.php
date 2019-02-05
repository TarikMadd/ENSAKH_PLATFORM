<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Destinataires Model
 *
 * @method \App\Model\Entity\Destinataire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Destinataire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Destinataire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Destinataire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Destinataire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Destinataire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Destinataire findOrCreate($search, callable $callback = null, $options = [])
 */
class DestinatairesTable extends Table
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

        $this->setTable('destinataires');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CourrierDeparts', [
            'foreignKey' => 'nomComplet_destinataire',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CourrierDeparts', [
            'foreignKey' => 'nomComplet_destinataire'
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
            ->requirePresence('nomComplet_destinataire', 'create')
            ->notEmpty('nomComplet_destinataire');

        $validator
            ->requirePresence('adresse_destinataire', 'create')
            ->notEmpty('adresse_destinataire');

        $validator
            ->requirePresence('email_destinataire', 'create')
            ->notEmpty('email_destinataire');

        $validator
            ->requirePresence('telephone_destinataire', 'create')
            ->notEmpty('telephone_destinataire');

        $validator
            ->requirePresence('ville_destinataire', 'create')
            ->notEmpty('ville_destinataire');

        return $validator;
    }
}
