<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProfesseursDepartement Entity
 *
 * @property int $id
 * @property int $professeur_id
 * @property int $departement_id
 * @property \Cake\I18n\Time $Date_debut
 * @property string $Poste_Filiere
 *
 * @property \App\Model\Entity\Professeur $professeur
 * @property \App\Model\Entity\Departement $departement
 */
class ProfesseursDepartement extends Entity
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
