<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vacation Entity
 *
 * @property int $id
 * @property int $mois
 * @property int $annee
 * @property int $nbHeure
 * @property \Cake\I18n\Time $dateInsertion
 * @property string $etat
 * @property int $vacataire_id
 * @property int $paimentvac_id
 *
 * @property \App\Model\Entity\Vacataire $vacataire
 * @property \App\Model\Entity\Paimentvac $paimentvac
 */
class Vacation extends Entity
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
