<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Semestre Entity
 *
 * @property int $id
 * @property string $libile
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 * @property int $niveaux_id
 *
 * @property \App\Model\Entity\Niveaux $niveaux
 * @property \App\Model\Entity\Enseigner[] $enseigners
 * @property \App\Model\Entity\PreinscriptionsInfo[] $preinscriptions_infos
 */
class Semestre extends Entity
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
