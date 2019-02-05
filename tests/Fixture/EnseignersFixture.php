<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EnseignersFixture
 *
 */
class EnseignersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'semestre_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'annee_scolaire_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'element_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'profpermanent_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'vacataire_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'enseigners_profpermanent_id_foreign' => ['type' => 'index', 'columns' => ['profpermanent_id'], 'length' => []],
            'enseigners_annee_scolaires_id_foreign' => ['type' => 'index', 'columns' => ['annee_scolaire_id'], 'length' => []],
            'enseigners_elements_id_foreign' => ['type' => 'index', 'columns' => ['element_id'], 'length' => []],
            'enseigners_semestres_id_foreign' => ['type' => 'index', 'columns' => ['semestre_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'enseigners_annee_scolaires_id_foreign' => ['type' => 'foreign', 'columns' => ['annee_scolaire_id'], 'references' => ['annee_scolaires', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'enseigners_elements_id_foreign' => ['type' => 'foreign', 'columns' => ['element_id'], 'references' => ['elements', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'enseigners_profpermanent_id_foreign' => ['type' => 'foreign', 'columns' => ['profpermanent_id'], 'references' => ['profpermanents', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'enseigners_semestres_id_foreign' => ['type' => 'foreign', 'columns' => ['semestre_id'], 'references' => ['semestres', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'semestre_id' => 1,
            'annee_scolaire_id' => 1,
            'element_id' => 1,
            'profpermanent_id' => 1,
            'vacataire_id' => 1
        ],
    ];
}
