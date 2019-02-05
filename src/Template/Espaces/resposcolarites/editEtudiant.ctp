<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
  <h1>
    Information de l'etudiant
    <small><?= __('Edition') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
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
            echo $this->Form->input('prenom_fr',array('label'=>'Prenom en Français'));
            echo $this->Form->input('prenom_ar',array('label'=>'Prenom en Arabe'));
            echo $this->Form->input('cne');
            echo $this->Form->input('cin');
            echo $this->Form->input('date_naissance',array('label'=>'Date de Naissance'));
            echo $this->Form->input('numero_tel',array('label'=>'Numero de telephone'));
            echo $this->Form->input('email');

            ?> <button class="btn-lg btn-block "><B>Informations sur la résidence<B></button>
            <?php 
            echo $this->Form->input('code_ville_naissance');
            echo $this->Form->input('ville_naissance_fr');
            echo $this->Form->input('ville_naissance_ar');
            echo $this->Form->input('code_pays_naissance');
            echo $this->Form->input('pays_naissance_fr');
            echo $this->Form->input('pays_naissance_ar');
            echo $this->Form->input('code_sexe');
            echo $this->Form->input('sexe_fr');
            echo $this->Form->input('sexe_ar');
            echo $this->Form->input('code_adresse_fix');
            echo $this->Form->input('adresse_fix_fr');
            echo $this->Form->input('adresse_fix_ar');
            echo $this->Form->input('adresse_annulle_fr');
            echo $this->Form->input('adresse_annulle_ar');
            ?> <button class="btn-lg btn-block "><B>Cursus<B></button>
            <?php 
            echo $this->Form->input('annee_1er_inscription_universite');
            echo $this->Form->input('annee_1er_inscription_enseignement_superieur');
            echo $this->Form->input('annee_1er_inscription_universite_marocaine');
            echo $this->Form->input('code_bac');
            echo $this->Form->input('serie_bac_fr');
            echo $this->Form->input('serie_bac_ar');
            echo $this->Form->input('code_etablissement_bac');
            echo $this->Form->input('etablissement_bac_fr');
            echo $this->Form->input('etablissement_bac_ar');
            echo $this->Form->input('code_mention_bac');
            echo $this->Form->input('mention_bac');
            echo $this->Form->input('code_province_bac');
            echo $this->Form->input('province_bac_fr');
            echo $this->Form->input('province_bac_ar');
            echo $this->Form->input('annee_bac');
            ?> <button class="btn-lg btn-block "><B>Autres<B></button>
            <?php 
            echo $this->Form->input('code_type_handicap');
            echo $this->Form->input('type_handicap');
            echo $this->Form->input('code_type_hebergement');
            echo $this->Form->input('type_hebergement');
            echo $this->Form->input('code_situation_familiale');
            echo $this->Form->input('situation_familiale');
            echo $this->Form->input('situation_militaire');
            echo $this->Form->input('categorie_socio_professionnelle');
            echo $this->Form->input('domaine_activite_professionnelle');
            echo $this->Form->input('quatite_Travaillee');
            echo $this->Form->input('profession_pere_fr');
            echo $this->Form->input('profession_pere_ar');
            echo $this->Form->input('profession_mere_fr');
            echo $this->Form->input('profession_mere_ar');
            echo $this->Form->input('code_province_parents');
            echo $this->Form->input('province_parents_fr');
            echo $this->Form->input('province_parents_ar');
            echo $this->Form->input('annee_sortie');
            echo $this->Form->input('code_cite_universiatire');
            echo $this->Form->input('cite_universiatire');
            echo $this->Form->input('certificats._ids', ['options' => $certificats]);
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
