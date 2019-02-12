<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Professeur Entity
 *
 * @property int $id
 * @property string $somme
 * @property string $poste
 * @property int $echelle
 * @property int $echelon
 * @property int $etat
 * @property \Cake\I18n\Time $date_Recrut
 * @property string $nom_prof
 * @property string $prenom_prof
 * @property int $age
 * @property int $nb_heures
 * @property string $diplome
 * @property string $specialite
 * @property string $universite
 * @property string $autresdiplomes
 * @property string $situation_familiale
 * @property int $code_situation_admin
 * @property \Cake\I18n\Time $dateNaissance
 * @property int $codeEtablissement
 * @property string $Lieu_Naissance
 * @property int $CIN
 *
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\Enseigner[] $enseigners
 * @property \App\Model\Entity\Mission[] $missions
 * @property \App\Model\Entity\SupHeure[] $sup_heures
 * @property \App\Model\Entity\Activite[] $activites
 * @property \App\Model\Entity\Departement[] $departements
 * @property \App\Model\Entity\Discipline[] $disciplines
 * @property \App\Model\Entity\Grade[] $grades
 */
class Professeur extends Entity
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
