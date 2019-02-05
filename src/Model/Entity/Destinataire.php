<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Destinataire Entity
 *
 * @property int $id
 * @property string $nomComplet_destinataire
 * @property string $adresse_destinataire
 * @property string $email_destinataire
 * @property string $telephone_destinataire
 * @property string $ville_destinataire
 */
class Destinataire extends Entity
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
