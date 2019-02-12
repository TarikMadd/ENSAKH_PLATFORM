<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activite Entity
 *
 * @property int $id
 * @property string $nomActivite
 * @property \Cake\I18n\Time $dateDebut
 * @property \Cake\I18n\Time $dateFin
 *
 * @property \App\Model\Entity\Organisation[] $organisations
 * @property \App\Model\Entity\Fonctionnaire[] $fonctionnaires
 * @property \App\Model\Entity\Professeur[] $professeurs
 * @property \App\Model\Entity\Vacataire[] $vacataires
 */
class Activite extends Entity
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
