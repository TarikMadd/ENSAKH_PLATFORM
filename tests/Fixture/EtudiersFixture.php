<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EtudiersFixture
 *
 */
class EtudiersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'etudiant_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'annee_scolaire_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'classe_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_at' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'updated_at' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'etudiers_etudiants_id_foreign' => ['type' => 'index', 'columns' => ['etudiant_id'], 'length' => []],
            'etudiers_annee_scolaires_id_foreign' => ['type' => 'index', 'columns' => ['annee_scolaire_id'], 'length' => []],
            'etudiers_classes_id_foreign' => ['type' => 'index', 'columns' => ['classe_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'etudiers_annee_scolaires_id_foreign' => ['type' => 'foreign', 'columns' => ['annee_scolaire_id'], 'references' => ['annee_scolaires', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'etudiers_classes_id_foreign' => ['type' => 'foreign', 'columns' => ['classe_id'], 'references' => ['groupes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'etudiers_etudiants_id_foreign' => ['type' => 'foreign', 'columns' => ['etudiant_id'], 'references' => ['etudiants', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'etudiant_id' => 1,
            'annee_scolaire_id' => 1,
            'classe_id' => 1,
            'created_at' => 1487424265,
            'updated_at' => 1487424265
        ],
    ];
}
