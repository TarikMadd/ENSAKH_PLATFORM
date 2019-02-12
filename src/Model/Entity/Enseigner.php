<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enseigner Entity
 *
 * @property int $id
 * @property int $semestre_id
 * @property int $annee_scolaire_id
 * @property int $element_id
 * @property int $professeur_id
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 *
 * @property \App\Model\Entity\Semestre $semestre
 * @property \App\Model\Entity\AnneeScolaire $annee_scolaire
 * @property \App\Model\Entity\Element $element
 * @property \App\Model\Entity\Professeur $professeur
 */
class Enseigner extends Entity
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
