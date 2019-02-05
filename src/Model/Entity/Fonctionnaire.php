<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fonctionnaire Entity
 *
 * @property int $id
 * @property int $somme
 * @property \Cake\I18n\Time $date_Recrut
 * @property int $echelle
 * @property int $echelon
 * @property float $salaire
 * @property int $etat
 * @property int $user_id
 * @property string $nom_fct
 * @property string $prenom_fct
 * @property \Cake\I18n\Time $dateNaissance
 * @property string $lieuNaissance
 * @property string $specialite
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Mission[] $missions
 * @property \App\Model\Entity\Activite[] $activites
 * @property \App\Model\Entity\Grade[] $grades
 * @property \App\Model\Entity\Service[] $services
 */
class Fonctionnaire extends Entity
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
