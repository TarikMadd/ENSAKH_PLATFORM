<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int $stock_categorie_id
 * @property string $label_article
 * @property int $quantite_min
 * @property string $marque
 * @property bool $utilite
 * @property int $quantite
 *
 * @property \App\Model\Entity\StockCategory $stock_category
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Mouvement[] $mouvements
 */
class Article extends Entity
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
