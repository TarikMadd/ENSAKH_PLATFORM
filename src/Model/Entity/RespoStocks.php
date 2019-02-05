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
/////////////////////////////////////////////////////////////////////////
/**
 * Commande Entity
 *
 * @property int $id
 * @property int $fournisseur_id
 * @property \Cake\I18n\Time $cree
 * @property int $article_id
 * @property int $nbr_article
 *
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Article $article
 */
class Commande extends Entity
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
////////////////////////////////////////////////////////////////////
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
/////////////////////////////////////////////////////////////////////////////
/**
 * Magasin Entity
 *
 * @property int $id
 * @property string $nom_magasin
 *
 * @property \App\Model\Entity\Mouvement[] $mouvements
 */
class Magasin extends Entity
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
///////////////////////////////////////////////////////////////////////////////
/**
 * Mouvement Entity
 *
 * @property \Cake\I18n\Time $date_mouvement
 * @property string $reference_entree
 * @property string $reference_sortie
 * @property int $quantite_entree
 * @property int $quantite_sortie
 * @property string $service
 * @property int $magasin_id
 * @property int $article_id
 *
 * @property \App\Model\Entity\Magasin $magasin
 * @property \App\Model\Entity\Article $article
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
        'magasin_id' => false,
        'article_id' => false
    ];
}
//////////////////////////////////////////////////////////////////////////////////////
/**
 * StockCategory Entity
 *
 * @property int $id
 * @property string $label_cat
 */
class StockCategory extends Entity
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