<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CertificatsEtudiant Entity
 *
 * @property int $id
 * @property int $certificat_id
 * @property int $etudiant_id
 * @property string $etat
 * @property string $commentaire
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $entreprise
 * @property string $raison_retrait
 * @property int $duree_stage
 * @property string $theme_stage
 * @property \Cake\I18n\Time $debut_stage
 * @property \Cake\I18n\Time $fin_stage
 * @property int $profpermanent_id
 *
 * @property \App\Model\Entity\Certificat $certificat
 * @property \App\Model\Entity\Etudiant $etudiant
 */
class CertificatsEtudiant extends Entity
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
