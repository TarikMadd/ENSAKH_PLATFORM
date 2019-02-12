<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Concour Entity
 *
 * @property int $id
 * @property int $niveaus_id
 * @property int $filiere_id
 * @property int $etat
 * @property \Cake\I18n\Time $date_debut
 * @property \Cake\I18n\Time $date_fin
 *
 * @property \App\Model\Entity\Niveau $niveau
 * @property \App\Model\Entity\Filiere $filiere
 * @property \App\Model\Entity\Preinscription[] $preinscriptions
 */
class Concour extends Entity
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
