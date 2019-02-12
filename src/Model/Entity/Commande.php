<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commande Entity
 *
 * @property int $id
 * @property int $fournisseur_id
 * @property \Cake\I18n\Time $cree
 * @property int $article_id
 * @property int $nbr_article
 * @property string $desciption
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
