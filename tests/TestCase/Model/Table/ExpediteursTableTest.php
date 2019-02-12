<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpediteursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpediteursTable Test Case
 */
class ExpediteursTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpediteursTable
     */
    public $Expediteurs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expediteurs',
        'app.courrier_arrivees',
        'app.destinataires',
        'app.courrier_arrivees_destinataires',
        'app.courrier_departs',
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
        $config = TableRegistry::exists('Expediteurs') ? [] : ['className' => 'App\Model\Table\ExpediteursTable'];
        $this->Expediteurs = TableRegistry::get('Expediteurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Expediteurs);

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
