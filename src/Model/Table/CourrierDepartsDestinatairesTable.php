<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourrierDepartsDestinataires Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Destinataires
 * @property \Cake\ORM\Association\BelongsTo $CourrierDeparts
 *
 * @method \App\Model\Entity\CourrierDepartsDestinataire get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourrierDepartsDestinataire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourrierDepartsDestinataire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepartsDestinataire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourrierDepartsDestinataire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepartsDestinataire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourrierDepartsDestinataire findOrCreate($search, callable $callback = null, $options = [])
 */
class CourrierDepartsDestinatairesTable extends Table
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

        $this->table('courrier_departs_destinataires');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Destinataires', [
            'foreignKey' => 'destinataire_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourrierDeparts', [
            'foreignKey' => 'courrier_depart_id',
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
        $rules->add($rules->existsIn(['destinataire_id'], 'Destinataires'));
        $rules->add($rules->existsIn(['courrier_depart_id'], 'CourrierDeparts'));

        return $rules;
    }
}
