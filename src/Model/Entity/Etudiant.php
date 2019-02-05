<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Etudiant Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $apogee
 * @property string $nom_fr
 * @property string $nom_ar
 * @property string $prenom_fr
 * @property string $prenom_ar
 * @property int $cne
 * @property string $cin
 * @property \Cake\I18n\Time $date_naissance
 * @property string $code_ville_naissance
 * @property string $ville_naissance_fr
 * @property string $ville_naissance_ar
 * @property string $code_pays_naissance
 * @property string $pays_naissance_fr
 * @property string $pays_naissance_ar
 * @property string $code_sexe
 * @property string $sexe_fr
 * @property string $sexe_ar
 * @property string $code_adresse_fix
 * @property string $adresse_fix_fr
 * @property string $adresse_fix_ar
 * @property string $adresse_annulle_fr
 * @property string $adresse_annulle_ar
 * @property string $annee_1er_inscription_universite
 * @property string $annee_1er_inscription_enseignement_superieur
 * @property string $annee_1er_inscription_universite_marocaine
 * @property string $code_bac
 * @property string $serie_bac_fr
 * @property string $serie_bac_ar
 * @property string $code_etablissement_bac
 * @property string $etablissement_bac_fr
 * @property string $etablissement_bac_ar
 * @property string $code_mention_bac
 * @property string $mention_bac
 * @property string $code_province_bac
 * @property string $province_bac_fr
 * @property string $province_bac_ar
 * @property string $annee_bac
 * @property string $code_type_handicap
 * @property string $type_handicap
 * @property string $code_type_hebergement
 * @property string $type_hebergement
 * @property string $code_situation_familiale
 * @property string $situation_familiale
 * @property string $situation_militaire
 * @property string $categorie_socio_professionnelle
 * @property string $domaine_activite_professionnelle
 * @property string $quatite_Travaillee
 * @property string $profession_pere_fr
 * @property string $profession_pere_ar
 * @property string $profession_mere_fr
 * @property string $profession_mere_ar
 * @property string $code_province_parents
 * @property string $province_parents_fr
 * @property string $province_parents_ar
 * @property string $annee_sortie
 * @property string $code_cite_universiatire
 * @property string $cite_universiatire
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $photo
 * @property int $validi
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Etudier[] $etudiers
 * @property \App\Model\Entity\Certificat[] $certificats
 */
class Etudiant extends Entity
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
