<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EtudiersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EtudiersController Test Case
 */
class EtudiersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.etudiers',
        'app.etudiants',
        'app.users',
        'app.certificats',
        'app.etudiants_certificats',
        'app.annee_scolaires',
        'app.groupes',
        'app.niveaux',
        'app.filieres',
        'app.notes'
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
