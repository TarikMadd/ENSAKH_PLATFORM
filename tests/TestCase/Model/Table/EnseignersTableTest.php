<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnseignersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnseignersTable Test Case
 */
class EnseignersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnseignersTable
     */
    public $Enseigners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.users',
        'app.certificats',
        'app.certificats_etudiants',
        'app.profpermanents',
        'app.missions',
        'app.fonctionnaires',
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
        'app.profpermanents_departements',
        'app.profvacataires_controller',
        'app.vacataires_departements',
        'app.disciplines',
        'app.vacataires_disciplines',
        'app.grades',
        'app.fonctionnaires_grades',
        'app.profpermanents_grades',
        'app.vacataires_grades',
        'app.sup_heures',
        'app.paimentsups',
        'app.prelevementsups',
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
        'app.villes',
        'app.notes_auth',
        'app.pvupdate',
        'app.notes',
        'app.elements',
        'app.modules',
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
        $config = TableRegistry::exists('Enseigners') ? [] : ['className' => 'App\Model\Table\EnseignersTable'];
        $this->Enseigners = TableRegistry::get('Enseigners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enseigners);

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
