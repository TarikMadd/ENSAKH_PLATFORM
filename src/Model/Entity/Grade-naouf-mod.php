<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Grade Entity
 *
 * @property int $id
 * @property int $codeGrade
 * @property float $taux
 * @property string $nomGrade
 * @property string $categorie
 *
 * @property \App\Model\Entity\Fonctionnaire[] $fonctionnaires
 * @property \App\Model\Entity\Profpermanent[] $profpermanents
 * @property \App\Model\Entity\Vacataire[] $vacataires
 */
class Grade extends Entity
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
