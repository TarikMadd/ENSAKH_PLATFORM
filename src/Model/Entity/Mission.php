<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mission Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $date_depart
 * @property \Cake\I18n\Time $date_arrivee
 * @property string $mode_transport
 * @property int $nbr_nuit
 * @property int $taux
 * @property float $indemnite_kilometrique
 * @property int $indemnite_appliquee
 * @property string $etat
 * @property float $total
 * @property int $fonctionnaire_id
 * @property int $profpermanent_id
 * @property int $ville_id
 *
 * @property \App\Model\Entity\Fonctionnaire $fonctionnaire
 * @property \App\Model\Entity\Profpermanent $profpermanent
 * @property \App\Model\Entity\Ville $ville
 */
class Mission extends Entity
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
