<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EtudiantsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EtudiantsTable Test Case
 */
class EtudiantsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EtudiantsTable
     */
    public $Etudiants;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.etudiants',
        'app.users',
        'app.etudiers',
        'app.annee_scolaires',
        'app.groupes',
        'app.niveaux',
        'app.filieres',
        'app.notes',
        'app.elements',
        'app.certificats',
        'app.etudiants_certificats'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Etudiants') ? [] : ['className' => 'App\Model\Table\EtudiantsTable'];
        $this->Etudiants = TableRegistry::get('Etudiants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Etudiants);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
