<?php
/**
 * @var \App\View\AppView $this
 */
?>

<section class="content-header">
    <h1>
        Information de l'étudiant
        <small><?= __('Edition') ?></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'index'], ['escape' => false]) ?>
        </li>
    </ol>
</section>
<section class="content-header">
    <div class="alert alert-danger alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-ban"></i> <?= __('Attention') ?>!</h4>
        <?= h('Les informations que vous allez saisir sont définitifs.') ?>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Formulaire d\'informations') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($etudiant, array('role' => 'form','type'=>'file')) ?>
                <div class="box-body">
                    <button class="btn-lg btn-block "><B>Informations Personnelles<B></button>
                    <?php

                    echo $this->Form->control('photo',array('type'=>'file'));
                    echo $this->Form->hidden('user_id', ['options' => $users, 'empty' => true]);


                    if($etudiant->photo){
                        $image = ltrim(str_replace("\\", "/", $etudiant->photo),'/img');
                    }else{
                        $image = "Etudiants\profile.jpg";
                    }



                    echo $this->Html->image($image, array('width' => 100, 'height' => 100));

                    echo $this->Form->input('apogee',array('label'=>'Code Apogée'));
                    echo $this->Form->input('nom_fr',array('label'=>'Nom en Français'));
                    echo $this->Form->input('nom_ar',array('label'=>'Nom en Arabe'));
                    echo $this->Form->input('prenom_fr',array('label'=>'Prénom en Français'));
                    echo $this->Form->input('prenom_ar',array('label'=>'Prénom en Arabe'));
                    echo $this->Form->input('cne');
                    echo $this->Form->input('cin');
                    echo $this->Form->input('date_naissance',array('label'=>'Date de Naissance'));
                    echo $this->Form->input('numero_tel',array('label'=>'Numéro de téléphone'));
                    echo $this->Form->input('email',array('label'=>'eMail'));

                    ?> <button class="btn-lg btn-block "><B>Informations sur la résidence<B></button>
                    <?php
                    echo $this->Form->input('code_ville_naissance',array('label'=>'Code de la ville de naissance'));
                    echo $this->Form->input('ville_naissance_fr',array('label'=>'Ville de naissance en français'));
                    echo $this->Form->input('ville_naissance_ar',array('label'=>'Ville de naissance en arabe'));
                    echo $this->Form->input('code_pays_naissance',array('label'=>'Code pays de naissance'));
                    echo $this->Form->input('pays_naissance_fr',array('label'=>'Pays naissance français'));
                    echo $this->Form->input('pays_naissance_ar',array('label'=>'Pays naissance arabe'));
                    echo $this->Form->input('code_sexe',array('label'=>'Code Sexe'));
                    echo $this->Form->input('sexe_fr',array('label'=>'Sexe en français'));
                    echo $this->Form->input('sexe_ar',array('label'=>'Sexe en arabe'));
                    echo $this->Form->input('code_adresse_fix',array('label'=>'Code Adresse fix '));
                    echo $this->Form->input('adresse_fix_fr',array('label'=>'Addresse fix en arabe'));
                    echo $this->Form->input('adresse_fix_ar',array('label'=>'Addresse fix en arabe'));
                    echo $this->Form->input('adresse_annulle_fr',array('label'=>'Addresse annuelle en français'));
                    echo $this->Form->input('adresse_annulle_ar',array('label'=>'Addresse annuelle en arabe'));
                    ?> <button class="btn-lg btn-block "><B>Dossier<B></button>
                    <?php
                    echo $this->Form->input('annee_1er_inscription_universite');
                    echo $this->Form->input('annee_1er_inscription_enseignement_superieur');
                    echo $this->Form->input('annee_1er_inscription_universite_marocaine');
                    echo $this->Form->input('code_bac');
                    echo $this->Form->input('serie_bac_fr',array('label'=>'Série de Bac en français'));
                    echo $this->Form->input('serie_bac_ar',array('label'=>'Série de Bac en arabe'));
                    echo $this->Form->input('code_etablissement_bac',array('label'=>'Code de l\établissement de l\'obtention de Bac'));
                    echo $this->Form->input('etablissement_bac_fr',array('label'=>'Etablissement d\'obtention de Bac en Français'));
                    echo $this->Form->input('etablissement_bac_ar',array('label'=>'Etablissement d\'obtention de Bac en Arabe'));
                    echo $this->Form->input('code_mention_bac',array('label'=>'Code de la mention du bac'));
                    echo $this->Form->input('mention_bac',array('label'=>'Mention du Bac'));
                    echo $this->Form->input('code_province_bac',array('label'=>'Code de la province du bac'));
                    echo $this->Form->input('province_bac_fr',array('label'=>'Province du bac en Français'));
                    echo $this->Form->input('province_bac_ar',array('label'=>'Province du bac en Arabe'));
                    echo $this->Form->input('annee_bac',array('label'=>'Année de l\'obtention du Bac'));
                    echo $this->Form->input('annee_sortie',array('label'=>'Année de Sortie'));
                    echo $this->Form->input('code_cite_universiatire',array('label'=>'Code cité univérsitaire'));
                    echo $this->Form->input('cite_universiatire',array('label'=>'Cité universitaire'));
                    ?> <button class="btn-lg btn-block "><B>Autres<B></button>
                    <?php
                    echo $this->Form->input('code_type_handicap',array('label'=>'Code du tupe de l\'handicap'));
                    echo $this->Form->input('type_handicap',array('label'=>'Type de l\'handicap'));
                    echo $this->Form->input('code_type_hebergement',array('label'=>'Code de type d\'hebergement'));
                    echo $this->Form->input('type_hebergement',array('label'=>'Type d\'hebergement'));
                    echo $this->Form->input('code_situation_familiale',array('label'=>'Code de la situation familiale'));
                    echo $this->Form->input('situation_familiale',array('label'=>'Situation Familiale'));
                    echo $this->Form->input('situation_militaire',array('label'=>'Situation militaire'));
                    echo $this->Form->input('categorie_socio_professionnelle',array('label'=>'Catégorie socio-professionnelle'));
                    echo $this->Form->input('domaine_activite_professionnelle',array('label'=>''));
                    echo $this->Form->input('quatite_Travaillee',array('label'=>'Qualité de Travaille'));
                    echo $this->Form->input('profession_pere_fr',array('label'=>'Profession du Père en français'));
                    echo $this->Form->input('profession_pere_ar',array('label'=>'Profession du Père en arabe'));
                    echo $this->Form->input('profession_mere_fr',array('label'=>'Profession de la mère en français'));
                    echo $this->Form->input('profession_mere_ar',array('label'=>'Profession de la mère en arabe'));
                    echo $this->Form->input('code_province_parents',array('label'=>'Code de la province des parents'));
                    echo $this->Form->input('province_parents_fr',array('label'=>'Province des parents en français'));
                    echo $this->Form->input('province_parents_ar',array('label'=>'Province des parents en arabe'));

                    echo $this->Form->hidden('valid_respo',['value' => 1]);
                    echo $this->Form->hidden('validi',['value' => 1]);
                    ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Valider les informations')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>