<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Actualiteclub Entity
 *
 * @property int $id
 * @property string $titre
 * @property \Cake\I18n\Time $date
 * @property string $texte
 * @property int $id_club
 * @property string $image
 * @property string $video
 * @property string $fichier
 */
class Actualiteclub extends Entity
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
