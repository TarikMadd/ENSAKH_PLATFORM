<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PreinscriptionsInfo Entity
 *
 * @property int $id
 * @property int $preinscriptions_diplome_id
 * @property int $preinscriptions_etablissement_id
 * @property int $preinscription_id
 * @property int $semestre_id
 * @property float $note
 * @property string $mention
 * @property string $anneeObtention
 *
 * @property \App\Model\Entity\PreinscriptionsDiplome $preinscriptions_diplome
 * @property \App\Model\Entity\PreinscriptionsEtablissement $preinscriptions_etablissement
 * @property \App\Model\Entity\Preinscription $preinscription
 * @property \App\Model\Entity\Semestre $semestre
 */
class PreinscriptionsInfo extends Entity
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
