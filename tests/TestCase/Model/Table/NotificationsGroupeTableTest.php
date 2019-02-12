<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationsGroupeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationsGroupeTable Test Case
 */
class NotificationsGroupeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationsGroupeTable
     */
    public $NotificationsGroupe;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notifications_groupe'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NotificationsGroupe') ? [] : ['className' => 'App\Model\Table\NotificationsGroupeTable'];
        $this->NotificationsGroupe = TableRegistry::get('NotificationsGroupe', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotificationsGroupe);

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
