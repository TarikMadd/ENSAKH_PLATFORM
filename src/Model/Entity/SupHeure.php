<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SupHeure Entity
 *
 * @property int $id
 * @property int $mois
 * @property int $annee
 * @property int $nbHeure
 * @property \Cake\I18n\Time $dateInsertion
 * @property string $etat
 * @property int $profpermanent_id
 * @property int $paimentsup_id
 *
 * @property \App\Model\Entity\Profpermanent $profpermanent
 * @property \App\Model\Entity\Paimentsup $paimentsup
 */
class SupHeure extends Entity
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
