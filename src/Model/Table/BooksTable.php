<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Books Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsTo $SousCategories
 * @property \Cake\ORM\Association\HasMany $Reservations
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Book get($primaryKey, $options = [])
 * @method \App\Model\Entity\Book newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Book[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Book|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Book[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Book findOrCreate($search, callable $callback = null, $options = [])
 */
class BooksTable extends Table
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

        $this->table('books');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'categori_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SousCategories', [
            'foreignKey' => 'sous_categorie_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'book_id'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'book_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_books'
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
            ->requirePresence('titre', 'create')
            ->notEmpty('titre');

        $validator
            ->requirePresence('auteur', 'create')
            ->notEmpty('auteur');

        $validator
            ->requirePresence('edition', 'create')
            ->notEmpty('edition');

        $validator
            ->requirePresence('resumer', 'create')
            ->notEmpty('resumer');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->requirePresence('ISBN', 'create')
            ->notEmpty('ISBN');

        $validator
            ->requirePresence('numInventaire', 'create')
            ->notEmpty('numInventaire')
            ->add('numInventaire', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('nbExemplaire')
            ->requirePresence('nbExemplaire', 'create')
            ->notEmpty('nbExemplaire');

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
        $rules->add($rules->isUnique(['numInventaire']));
        $rules->add($rules->existsIn(['categori_id'], 'Categories'));
        $rules->add($rules->existsIn(['sous_categorie_id'], 'SousCategories'));

        return $rules;
    }
}
