<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MissionsTable Test Case
 */
class MissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MissionsTable
     */
    public $Missions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.missions',
        'app.fonctionnaires',
        'app.users',
        'app.activites',
        'app.organisations',
        'app.fonctionnaires_activites',
        'app.professeurs',
        'app.documents',
        'app.vacataires',
        'app.vacations',
        'app.paimentvacs',
        'app.prelevements',
        'app.vacataires_activites',
        'app.departements',
        'app.profpermanents',
        'app.enseigners',
        'app.semestres',
        'app.niveaux',
        'app.classes',
        'app.filieres',
        'app.concours',
        'app.niveaus',
        'app.preinscriptions',
        'app.preinscriptions_infos',
        'app.preinscriptions_diplomes',
        'app.preinscriptions_etablissements',
        'app.activitesdespreinscriptions',
        'app.activitesdespreinscriptions_preinscriptions',
        'app.groupes',
        'app.annee_scolaires',
        'app.etudiers',
        'app.etudiants',
        'app.certificats',
        'app.certificats_etudiants',
        'app.elements',
        'app.modules',
        'app.notes',
        'app.notes_auth',
        'app.pvupdate',
        'app.sup_heures',
        'app.paimentsups',
        'app.prelevementsups',
        'app.profpermanents_activites',
        'app.profpermanents_departements',
        'app.disciplines',
        'app.profpermanents_disciplines',
        'app.profpermanents_documents',
        'app.grades',
        'app.fonctionnaires_grades',
        'app.profpermanents_grades',
        'app.vacataires_grades',
        'app.profvacataires_controller',
        'app.vacataires_departements',
        'app.vacataires_disciplines',
        'app.professeurs_activites',
        'app.professeurs_departements',
        'app.professeurs_disciplines',
        'app.professeurs_grades',
        'app.services',
        'app.courrier_arrivees',
        'app.expediteurs',
        'app.courrier_departs',
        'app.destinataires',
        'app.fonctionnaires_services',
        'app.villes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Missions') ? [] : ['className' => 'App\Model\Table\MissionsTable'];
        $this->Missions = TableRegistry::get('Missions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Missions);

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
