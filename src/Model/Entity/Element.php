<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Element Entity
 *
 * @property int $id
 * @property string $code
 * @property string $libile
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 * @property int $module_id
 *
 * @property \App\Model\Entity\Module $module
 * @property \App\Model\Entity\Enseigner[] $enseigners
 * @property \App\Model\Entity\Note[] $notes
 */
class Element extends Entity
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
