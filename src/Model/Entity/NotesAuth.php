<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NotesAuth Entity
 *
 * @property int $id
 * @property int $profpermanent_id
 * @property string $key_module
 * @property \Cake\I18n\Time $date_valide
 * @property bool $for_ratt
 * @property bool $pv
 *
 * @property \App\Model\Entity\Profpermanent $profpermanent
 */
class NotesAuth extends Entity
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
