<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mouvement Entity
 *
 * @property int $id
 * @property int $article_id
 * @property int $magasin_id
 * @property \Cake\I18n\Time $date_mouvement
 * @property string $reference_entree
 * @property string $reference_sortie
 * @property int $quantite_entree
 * @property int $quantite_sortie
 * @property string $service
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Magasin $magasin
 */
class Mouvement extends Entity
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
