<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VacatairesGrade Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $datedebut
 * @property \Cake\I18n\Time $datefin
 * @property int $grade_id
 * @property int $vacataire_id
 *
 * @property \App\Model\Entity\Grade $grade
 * @property \App\Model\Entity\Vacataire $vacataire
 */
class VacatairesGrade extends Entity
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
