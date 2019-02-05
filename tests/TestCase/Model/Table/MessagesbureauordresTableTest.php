<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessagesbureauordresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessagesbureauordresTable Test Case
 */
class MessagesbureauordresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessagesbureauordresTable
     */
    public $Messagesbureauordres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.messagesbureauordres',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Messagesbureauordres') ? [] : ['className' => 'App\Model\Table\MessagesbureauordresTable'];
        $this->Messagesbureauordres = TableRegistry::get('Messagesbureauordres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Messagesbureauordres);

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
