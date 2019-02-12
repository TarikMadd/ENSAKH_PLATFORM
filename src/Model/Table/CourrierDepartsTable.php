<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourrierDeparts Model
 *
 * @method \App\Model\Entity\CourrierDepart get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourrierDepart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourrierDepart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourrierDepart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepart findOrCreate($search, callable $callback = null, $options = [])
 */
class CourrierDepartsTable extends Table
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

        $this->table('courrier_departs');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Destinataires', [
            'foreignKey' => 'nomComplet_destinataire',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Destinataires', [
            'foreignKey' => 'id',
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
            ->dateTime('date_depart')
            ->requirePresence('date_depart', 'create')
            ->notEmpty('date_depart');

        $validator
            ->requirePresence('désignation', 'create')
            ->notEmpty('désignation');

        $validator
            ->requirePresence('service', 'create')
            ->notEmpty('service');

        $validator
            ->requirePresence('nomComplet_destinataire', 'create')
            ->notEmpty('nomComplet_destinataire');

        $validator
            ->requirePresence('type_courrier', 'create')
            ->notEmpty('type_courrier');

        $validator
            ->requirePresence('etat_courrier', 'create')
            ->notEmpty('etat_courrier');

        $validator
            ->requirePresence('courrier', 'create')
            ->notEmpty('courrier');

        $validator
            ->requirePresence('accuse', 'create')
            ->notEmpty('accuse');

        return $validator;
    }
}
