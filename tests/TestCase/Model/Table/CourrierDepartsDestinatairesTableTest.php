<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourrierDepartsDestinatairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourrierDepartsDestinatairesTable Test Case
 */
class CourrierDepartsDestinatairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourrierDepartsDestinatairesTable
     */
    public $CourrierDepartsDestinataires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courrier_departs_destinataires',
        'app.destinataires',
        'app.courrier_departs',
        'app.expediteurs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourrierDepartsDestinataires') ? [] : ['className' => 'App\Model\Table\CourrierDepartsDestinatairesTable'];
        $this->CourrierDepartsDestinataires = TableRegistry::get('CourrierDepartsDestinataires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourrierDepartsDestinataires);

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
