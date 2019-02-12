<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Departement Entity
 *
 * @property int $id
 * @property string $nom_departement
 * @property int $nb_filiere
 * @property int $refer_depart
 *
 * @property \App\Model\Entity\Profpermanent[] $profpermanents
 * @property \App\Model\Entity\Vacataire[] $vacataires
 */
class Departement extends Entity
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
