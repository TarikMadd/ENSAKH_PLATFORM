<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Paimentsupp Entity
 *
 * @property int $id
 * @property string $type
 * @property \Cake\I18n\Time $datepaiment
 * @property string $etatsomme
 * @property string $ordrepaiment
 * @property int $compte_id
 * @property int $ordrevirment_id
 *
 * @property \App\Model\Entity\Compte $compte
 * @property \App\Model\Entity\Ordrevirment $ordrevirment
 */
class Paimentsupp extends Entity
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
