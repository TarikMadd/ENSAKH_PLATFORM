<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expediteurs Model
 *
 * @property \Cake\ORM\Association\HasMany $CourrierArrivees
 * @property \Cake\ORM\Association\HasMany $CourrierDeparts
 *
 * @method \App\Model\Entity\Expediteur get($primaryKey, $options = [])
 * @method \App\Model\Entity\Expediteur newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Expediteur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Expediteur|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expediteur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Expediteur[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Expediteur findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpediteursTable extends Table
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

        $this->table('expediteurs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('CourrierArrivees', [
            'foreignKey' => 'expediteur_id'
        ]);
        $this->hasMany('CourrierDeparts', [
            'foreignKey' => 'expediteur_id'
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
            ->allowEmpty('nomComplet_expediteur');

        $validator
            ->allowEmpty('adresse_expediteur');

        $validator
            ->allowEmpty('email_expediteur');

        $validator
            ->integer('telephone_expediteur')
            ->allowEmpty('telephone_expediteur');

        $validator
            ->allowEmpty('ville_expediteur');

        return $validator;
    }
}
