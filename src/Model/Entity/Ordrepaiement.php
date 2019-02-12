<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ordrepaiement Entity
 *
 * @property int $id
 * @property int $identificateur_fiscale
 * @property int $num_compte_fournisseur
 * @property int $num_compte_paiement
 * @property int $num_facture
 * @property int $exercice
 * @property \Cake\I18n\Time $date
 * @property int $devisdemande_id
 * @property string $banque
 *
 * @property \App\Model\Entity\Boncommande $boncommande
 */
class Ordrepaiement extends Entity
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
