<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Articleevent Entity
 *
 * @property int $id
 * @property string $desigantion
 * @property int $quantite
 * @property float $prix_unitaire_ht
 * @property int $devisdemande_id
 *
 * @property \App\Model\Entity\Devisdemande $devisdemande
 */
class Articleevent extends Entity
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
