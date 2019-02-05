<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourrierArrivee Entity
 *
 * @property \Cake\I18n\Time $date_arrivee
 * @property string $Désignation
 * @property int $expediteur_id
 * @property string $type_courrier
 * @property string $Priorité
 * @property \Cake\I18n\Time $date_limite_du_traitement
 * @property string $etat_du_courrier
 * @property int $service_id
 * @property string $necessité_du_traitement
 * @property int $id
 * @property string $courrier
 * @property string $accuse
 *
 * @property \App\Model\Entity\Expediteur $expediteur
 * @property \App\Model\Entity\Service $service
 */
class CourrierArrivee extends Entity
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
