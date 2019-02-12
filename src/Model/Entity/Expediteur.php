<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expediteur Entity
 *
 * @property int $id
 * @property string $nomComplet_expediteur
 * @property string $adresse_expediteur
 * @property string $email_expediteur
 * @property int $telephone_expediteur
 * @property string $ville_expediteur
 *
 * @property \App\Model\Entity\CourrierArrivee[] $courrier_arrivees
 * @property \App\Model\Entity\CourrierDepart[] $courrier_departs
 */
class Expediteur extends Entity
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
