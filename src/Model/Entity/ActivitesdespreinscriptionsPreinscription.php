<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivitesdespreinscriptionsPreinscription Entity
 *
 * @property int $id
 * @property int $preinscriptions_id
 * @property int $activitesdespreinscription_id
 *
 * @property \App\Model\Entity\Preinscription $preinscription
 * @property \App\Model\Entity\Activitesdespreinscription $activitesdespreinscription
 */
class ActivitesdespreinscriptionsPreinscription extends Entity
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
