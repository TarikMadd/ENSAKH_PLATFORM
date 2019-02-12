<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activitesdespreinscriptions Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Preinscriptions
 *
 * @method \App\Model\Entity\Activitesdespreinscription get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activitesdespreinscription newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Activitesdespreinscription[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activitesdespreinscription|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activitesdespreinscription patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activitesdespreinscription[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activitesdespreinscription findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivitesdespreinscriptionsTable extends Table
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

        $this->table('activitesdespreinscriptions');
        $this->displayField('id');
        $this->primaryKey('id');

        /*$this->belongsToMany('Preinscriptions', [
            'foreignKey' => 'activitesdespreinscription_id',
            'targetForeignKey' => 'preinscription_id',
            'joinTable' => 'activitesdespreinscriptions_preinscriptions'
        ]);*/
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
            ->requirePresence('libile', 'create')
            ->notEmpty('libile');

        return $validator;
    }
}
