<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfpermanentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfpermanentsTable Test Case
 */
class ProfpermanentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfpermanentsTable
     */
    public $Profpermanents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.profpermanents',
        'app.users',
        'app.enseigners',
        'app.semestres',
        'app.niveaux',
        'app.classes',
        'app.filieres',
        'app.concours',
        'app.niveaus',
        'app.preinscriptions',
        'app.preinscriptions_infos',
        'app.groupes',
        'app.annee_scolaires',
        'app.etudiers',
        'app.etudiants',
        'app.certificats',
        'app.certificats_etudiants',
        'app.notes',
        'app.elements',
        'app.modules',
        'app.professeurs',
        'app.documents',
        'app.vacataires',
        'app.vacations',
        'app.paimentvacs',
        'app.prelevements',
        'app.activites',
        'app.organisations',
        'app.fonctionnaires',
        'app.missions',
        'app.villes',
        'app.fonctionnaires_activites',
        'app.grades',
        'app.fonctionnaires_grades',
        'app.profpermanents_grades',
        'app.vacataires_grades',
        'app.services',
        'app.courrier_arrivees',
        'app.expediteurs',
        'app.courrier_departs',
        'app.destinataires',
        'app.fonctionnaires_services',
        'app.professeurs_activites',
        'app.vacataires_activites',
        'app.departements',
        'app.profpermanents_departements',
        'app.profvacataires_controller',
        'app.vacataires_departements',
        'app.disciplines',
        'app.vacataires_disciplines',
        'app.sup_heures',
        'app.paimentsups',
        'app.prelevementsups',
        'app.professeurs_departements',
        'app.professeurs_disciplines',
        'app.professeurs_grades',
        'app.profpermanents_activites',
        'app.profpermanents_disciplines',
        'app.profpermanents_documents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Profpermanents') ? [] : ['className' => 'App\Model\Table\ProfpermanentsTable'];
        $this->Profpermanents = TableRegistry::get('Profpermanents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Profpermanents);

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
