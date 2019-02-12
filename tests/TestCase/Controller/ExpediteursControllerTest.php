<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ExpediteursController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ExpediteursController Test Case
 */
class ExpediteursControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
