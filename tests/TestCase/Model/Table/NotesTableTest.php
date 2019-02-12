<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotesTable Test Case
 */
class NotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotesTable
     */
    public $Notes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notes',
        'app.elements',
        'app.modules',
        'app.classes',
        'app.niveaux',
        'app.concours',
        'app.niveaus',
        'app.filieres',
        'app.groupes',
        'app.preinscriptions',
        'app.preinscriptions_infos',
        'app.preinscriptions_diplomes',
        'app.preinscriptions_etablissements',
        'app.semestres',
        'app.enseigners',
        'app.annee_scolaires',
        'app.etudiers',
        'app.etudiants',
        'app.users',
        'app.certificats',
        'app.certificats_etudiants',
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
        'app.profpermanents',
        'app.notes_auth',
        'app.pvupdate',
        'app.sup_heures',
        'app.paimentsups',
        'app.prelevementsups',
        'app.profpermanents_activites',
        'app.departements',
        'app.profpermanents_departements',
        'app.profvacataires_controller',
        'app.vacataires_departements',
        'app.disciplines',
        'app.profpermanents_disciplines',
        'app.profpermanents_documents',
        'app.grades',
        'app.fonctionnaires_grades',
        'app.profpermanents_grades',
        'app.vacataires_grades',
        'app.villes',
        'app.fonctionnaires_activites',
        'app.services',
        'app.courrier_arrivees',
        'app.expediteurs',
        'app.courrier_departs',
        'app.destinataires',
        'app.fonctionnaires_services',
        'app.professeurs_activites',
        'app.vacataires_activites',
        'app.vacataires_disciplines',
        'app.professeurs_departements',
        'app.professeurs_disciplines',
        'app.professeurs_grades',
        'app.activitesdespreinscriptions',
        'app.activitesdespreinscriptions_preinscriptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Notes') ? [] : ['className' => 'App\Model\Table\NotesTable'];
        $this->Notes = TableRegistry::get('Notes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notes);

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
