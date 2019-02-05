<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fournisseur Entity
 *
 * @property int $id
 * @property int $stock_categorie_id
 * @property string $nom_fournisseur
 * @property string $prenom_fournisseur
 * @property string $label_fournisseur
 * @property string $adresse
 * @property string $email
 *
 * @property \App\Model\Entity\StockCategory $stock_category
 * @property \App\Model\Entity\Commande[] $commandes
 */
class Fournisseur extends Entity
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
