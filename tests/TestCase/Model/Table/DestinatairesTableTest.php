<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DestinatairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DestinatairesTable Test Case
 */
class DestinatairesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DestinatairesTable
     */
    public $Destinataires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.destinataires'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Destinataires') ? [] : ['className' => 'App\Model\Table\DestinatairesTable'];
        $this->Destinataires = TableRegistry::get('Destinataires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Destinataires);

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
