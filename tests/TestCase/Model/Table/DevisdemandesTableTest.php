<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DevisdemandesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DevisdemandesTable Test Case
 */
class DevisdemandesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DevisdemandesTable
     */
    public $Devisdemandes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.devisdemandes',
        'app.articleevents',
        'app.boncommandes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Devisdemandes') ? [] : ['className' => 'App\Model\Table\DevisdemandesTable'];
        $this->Devisdemandes = TableRegistry::get('Devisdemandes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Devisdemandes);

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
}
