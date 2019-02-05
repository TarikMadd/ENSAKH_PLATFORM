<section class="content-header">
  <h1>
    Etudiant
    <small><?= __('Add') ?></small>
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
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($etudiant, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('apogee');
            echo $this->Form->input('nom_fr');
            echo $this->Form->input('nom_ar');
            echo $this->Form->input('prenom_fr');
            echo $this->Form->input('prenom_ar');
            echo $this->Form->input('cne');
            echo $this->Form->input('cin');
            echo $this->Form->input('date_naissance', ['empty' => true, 'default' => '']);
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
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
