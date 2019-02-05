<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourrierDepartsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourrierDepartsTable Test Case
 */
class CourrierDepartsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourrierDepartsTable
     */
    public $CourrierDeparts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courrier_departs',
        'app.expediteurs',
        'app.destinataires',
        'app.courrier_departs_destinataires'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourrierDeparts') ? [] : ['className' => 'App\Model\Table\CourrierDepartsTable'];
        $this->CourrierDeparts = TableRegistry::get('CourrierDeparts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourrierDeparts);

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
