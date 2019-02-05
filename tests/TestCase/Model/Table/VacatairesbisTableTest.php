<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VacatairesbisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VacatairesbisTable Test Case
 */
class VacatairesbisTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VacatairesbisTable
     */
    public $Vacatairesbis;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vacatairesbis',
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
        $config = TableRegistry::exists('Vacatairesbis') ? [] : ['className' => 'App\Model\Table\VacatairesbisTable'];
        $this->Vacatairesbis = TableRegistry::get('Vacatairesbis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vacatairesbis);

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
