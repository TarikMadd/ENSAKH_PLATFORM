<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourrierDepart Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $date_depart
 * @property string $désignation
 * @property string $service
 * @property string $nomComplet_destinataire
 * @property string $type_courrier
 * @property string $etat_courrier
 * @property string $courrier
 * @property string $accuse
 *
 * @property \App\Model\Entity\Expediteur $expediteur
 * @property \App\Model\Entity\Destinataire[] $destinataires
 */
class CourrierDepart extends Entity
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
