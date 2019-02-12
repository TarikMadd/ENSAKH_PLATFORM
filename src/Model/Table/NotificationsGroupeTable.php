<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NotificationsGroupe Model
 *
 * @method \App\Model\Entity\NotificationsGroupe get($primaryKey, $options = [])
 * @method \App\Model\Entity\NotificationsGroupe newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NotificationsGroupe[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NotificationsGroupe|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NotificationsGroupe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NotificationsGroupe[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NotificationsGroupe findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NotificationsGroupeTable extends Table
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

        $this->setTable('notifications_groupe');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('titre', 'create')
            ->notEmpty('titre');

        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');

        $validator
            ->requirePresence('principale', 'create')
            ->notEmpty('principale');

        $validator
            ->allowEmpty('commentaire');

        $validator
            ->requirePresence('lien', 'create')
            ->notEmpty('lien');

        $validator
            ->requirePresence('style', 'create')
            ->notEmpty('style');

        return $validator;
    }
}
