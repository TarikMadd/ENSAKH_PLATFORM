<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EtudiersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EtudiersTable Test Case
 */
class EtudiersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EtudiersTable
     */
    public $Etudiers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.etudiers',
        'app.etudiants',
        'app.users',
        'app.certificats',
        'app.etudiants_certificats',
        'app.annee_scolaires',
        'app.groupes',
        'app.niveaux',
        'app.filieres',
        'app.notes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Etudiers') ? [] : ['className' => 'App\Model\Table\EtudiersTable'];
        $this->Etudiers = TableRegistry::get('Etudiers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Etudiers);

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
