<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Document Entity
 *
 * @property int $id
 * @property int $idDocument
 * @property int $nbDocument
 * @property string $nomDocument
 * @property int $professeur_id
 * @property int $vacataire_id
 * @property int $fonctionnaire_id
 *
 * @property \App\Model\Entity\Professeur $professeur
 * @property \App\Model\Entity\Vacataire $vacataire
 * @property \App\Model\Entity\Fonctionnaire $fonctionnaire
 */
class Document extends Entity
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
