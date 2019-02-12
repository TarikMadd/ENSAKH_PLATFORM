<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FonctionnairesDocument Entity
 *
 * @property int $id
 * @property int $fonctionnaire_id
 * @property int $document_id
 * @property \Cake\I18n\Time $dateDemande
 * @property string $etatdemande
 *
 * @property \App\Model\Entity\Fonctionnaire $fonctionnaire
 * @property \App\Model\Entity\Document $document
 */
class FonctionnairesDocument extends Entity
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
