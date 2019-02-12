<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CertificatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CertificatsTable Test Case
 */
class CertificatsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CertificatsTable
     */
    public $Certificats;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.certificats',
        'app.etudiants',
        'app.users',
        'app.etudiers',
        'app.annee_scolaires',
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
        'app.elements',
        'app.modules',
        'app.notes',
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
        'app.certificats_etudiants'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Certificats') ? [] : ['className' => 'App\Model\Table\CertificatsTable'];
        $this->Certificats = TableRegistry::get('Certificats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Certificats);

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
