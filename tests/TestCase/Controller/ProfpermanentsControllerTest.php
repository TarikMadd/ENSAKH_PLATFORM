<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProfpermanentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ProfpermanentsController Test Case
 */
class ProfpermanentsControllerTest extends IntegrationTestCase
{

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
        'app.profpermanents',
        'app.sup_heures',
        'app.paimentsups',
        'app.prelevementsups',
        'app.profpermanents_activites',
        'app.departements',
        'app.profpermanents_departements',
        'app.profvacataires_controller',
        'app.vacataires_departements',
        'app.professeurs_departements',
        'app.disciplines',
        'app.vacataires_disciplines',
        'app.professeurs_disciplines',
        'app.profpermanents_disciplines',
        'app.profpermanents_documents',
        'app.grades',
        'app.fonctionnaires_grades',
        'app.profpermanents_grades',
        'app.vacataires_grades',
        'app.professeurs_grades',
        'app.villes',
        'app.fonctionnaires_activites',
        'app.services',
        'app.courrier_arrivees',
        'app.expediteurs',
        'app.courrier_departs',
        'app.destinataires',
        'app.fonctionnaires_services',
        'app.professeurs_activites',
        'app.vacataires_activites'
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
