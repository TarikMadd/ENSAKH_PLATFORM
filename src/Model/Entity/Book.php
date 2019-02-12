<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $titre
 * @property string $auteur
 * @property string $edition
 * @property string $resumer
 * @property string $image
 * @property string $ISBN
 * @property string $numInventaire
 * @property int $nbExemplaire
 * @property int $categori_id
 * @property int $sous_categorie_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\SousCategory $sous_category
 * @property \App\Model\Entity\Reservation[] $reservations
 * @property \App\Model\Entity\User[] $users
 */
class Book extends Entity
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
