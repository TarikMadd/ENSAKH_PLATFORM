<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourrierArriveesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourrierArriveesTable Test Case
 */
class CourrierArriveesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourrierArriveesTable
     */
    public $CourrierArrivees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courrier_arrivees',
        'app.expediteurs',
        'app.destinataires',
        'app.courrier_arrivees_destinataires'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourrierArrivees') ? [] : ['className' => 'App\Model\Table\CourrierArriveesTable'];
        $this->CourrierArrivees = TableRegistry::get('CourrierArrivees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourrierArrivees);

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
