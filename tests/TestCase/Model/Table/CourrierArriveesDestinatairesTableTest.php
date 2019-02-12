<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourrierArriveesDestinatairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourrierArriveesDestinatairesTable Test Case
 */
class CourrierArriveesDestinatairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourrierArriveesDestinatairesTable
     */
    public $CourrierArriveesDestinataires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courrier_arrivees_destinataires',
        'app.destinataires',
        'app.courrier_arrivees',
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
        $config = TableRegistry::exists('CourrierArriveesDestinataires') ? [] : ['className' => 'App\Model\Table\CourrierArriveesDestinatairesTable'];
        $this->CourrierArriveesDestinataires = TableRegistry::get('CourrierArriveesDestinataires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourrierArriveesDestinataires);

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
