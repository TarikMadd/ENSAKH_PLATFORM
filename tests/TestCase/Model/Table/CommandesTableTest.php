<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommandesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommandesTable Test Case
 */
class CommandesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommandesTable
     */
    public $Commandes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.commandes',
        'app.fournisseurs',
        'app.stock_categories',
        'app.articles',
        'app.mouvements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Commandes') ? [] : ['className' => 'App\Model\Table\CommandesTable'];
        $this->Commandes = TableRegistry::get('Commandes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Commandes);

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
