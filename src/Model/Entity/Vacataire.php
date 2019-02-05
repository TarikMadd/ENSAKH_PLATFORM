<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vacataire Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $somme
 * @property string $nom_vacataire
 * @property string $prenom_vacataire
 * @property int $nb_heures
 * @property int $echelle
 * @property int $echelon
 * @property \Cake\I18n\Time $dateRecrut
 * @property \Cake\I18n\Time $dateNaissance
 * @property string $LieuNaissance
 * @property string $diplome
 * @property string $universite
 * @property string $specialite
 * @property string $CIN
 * @property string $situationFamiliale
 * @property string $codeSituation
 * @property \Cake\I18n\Time $dateAffectation
 *
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\Vacation[] $vacations
 * @property \App\Model\Entity\Activite[] $activites
 * @property \App\Model\Entity\Departement[] $departements
 * @property \App\Model\Entity\Discipline[] $disciplines
 * @property \App\Model\Entity\Grade[] $grades
 */
class Vacataire extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
