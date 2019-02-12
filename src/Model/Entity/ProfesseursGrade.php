<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProfesseursGrade Entity
 *
 * @property int $professeur_id
 * @property int $grade_id
 * @property int $id
 * @property \Cake\I18n\Time $date_grade
 *
 * @property \App\Model\Entity\Professeur $professeur
 * @property \App\Model\Entity\Grade $grade
 */
class ProfesseursGrade extends Entity
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
