<section class="content-header">
  <h1>
    <?php echo __('Etudiant'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php 
                $fil="";
                foreach ($etudiant->etudiers as $etudiers) {
                    $fil=$etudiers->groupe->niveau->libile . " " .$etudiers->groupe->filiere->libile;
                } ?>
                <dl class="dl-horizontal">

               <?php 
               if($etudiant->photo){
                    $image = ltrim(str_replace("\\", "/", $etudiant->photo),'/img');
               }else{
                    $image = "Etudiants\profile.jpg";
               }
                

               ?>     
            <button class="btn-lg btn-block "><B>Informations Personnelles<B></button>

                    <dt><?= __('Photo') ?></dt>
                                        <dd>
            <?php echo $this->Html->image($image, array('width' => '200px', 'height' => '200px')); ?>
                                            <dt>Classe</dt>
                                        <dd>
                                            <?= h($fil) ?>
                                                                                                                        <dt><?= __('Apogee') ?></dt>
                                        <dd>
                                            <?= h($etudiant->apogee) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Cne') ?></dt>
                                <dd>
                                    <?= h($etudiant->cne) ?>
                                </dd>
                                                                                                                                                            <dt><?= __('Nom Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->nom_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Nom Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->nom_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->prenom_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->prenom_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Cin') ?></dt>
                                        <dd>
                                            <?= h($etudiant->cin) ?>
                                        </dd>

                                                                                                
                                                                                                        <dt><?= __('Date Naissance') ?></dt>
                                <dd>
                                    <?= h($etudiant->date_naissance) ?>
                                </dd>
                                        <button class="btn-lg btn-block "><B>Informations sur la résidence<B></button>
                                                                                                                                                            <dt><?= __('Code Ville Naissance') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_ville_naissance) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ville Naissance Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->ville_naissance_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Ville Naissance Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->ville_naissance_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Pays Naissance') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_pays_naissance) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Pays Naissance Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->pays_naissance_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Pays Naissance Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->pays_naissance_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Sexe') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_sexe) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Sexe Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->sexe_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Sexe Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->sexe_ar) ?>
                                        </dd>
                                        <button class="btn-lg btn-block "><B>Cursus<B></button>
                                                                                                                                                            <dt><?= __('Annee 1er Inscription Universite') ?></dt>
                                        <dd>
                                            <?= h($etudiant->annee_1er_inscription_universite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Annee 1er Inscription Enseignement Superieur') ?></dt>
                                        <dd>
                                            <?= h($etudiant->annee_1er_inscription_enseignement_superieur) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Annee 1er Inscription Universite Marocaine') ?></dt>
                                        <dd>
                                            <?= h($etudiant->annee_1er_inscription_universite_marocaine) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Bac') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_bac) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Serie Bac Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->serie_bac_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Serie Bac Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->serie_bac_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Etablissement Bac') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_etablissement_bac) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Etablissement Bac Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->etablissement_bac_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Etablissement Bac Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->etablissement_bac_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Mention Bac') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_mention_bac) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Mention Bac') ?></dt>
                                        <dd>
                                            <?= h($etudiant->mention_bac) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Province Bac') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_province_bac) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Province Bac Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->province_bac_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Province Bac Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->province_bac_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Annee Bac') ?></dt>
                                        <dd>
                                            <?= h($etudiant->annee_bac) ?>
                                        </dd><button class="btn-lg btn-block "><B>Autres<B></button>
                                                                                                                                                            <dt><?= __('Code Type Handicap') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_type_handicap) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Type Handicap') ?></dt>
                                        <dd>
                                            <?= h($etudiant->type_handicap) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Type Hebergement') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_type_hebergement) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Type Hebergement') ?></dt>
                                        <dd>
                                            <?= h($etudiant->type_hebergement) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Situation Familiale') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_situation_familiale) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Situation Familiale') ?></dt>
                                        <dd>
                                            <?= h($etudiant->situation_familiale) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Situation Militaire') ?></dt>
                                        <dd>
                                            <?= h($etudiant->situation_militaire) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Categorie Socio Professionnelle') ?></dt>
                                        <dd>
                                            <?= h($etudiant->categorie_socio_professionnelle) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Domaine Activite Professionnelle') ?></dt>
                                        <dd>
                                            <?= h($etudiant->domaine_activite_professionnelle) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Quatite Travaillee') ?></dt>
                                        <dd>
                                            <?= h($etudiant->quatite_Travaillee) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Profession Pere Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->profession_pere_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Profession Pere Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->profession_pere_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Profession Mere Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->profession_mere_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Profession Mere Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->profession_mere_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Province Parents') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_province_parents) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Province Parents Fr') ?></dt>
                                        <dd>
                                            <?= h($etudiant->province_parents_fr) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Province Parents Ar') ?></dt>
                                        <dd>
                                            <?= h($etudiant->province_parents_ar) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Annee Sortie') ?></dt>
                                        <dd>
                                            <?= h($etudiant->annee_sortie) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Code Cite Universiatire') ?></dt>
                                        <dd>
                                            <?= h($etudiant->code_cite_universiatire) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Cite Universiatire') ?></dt>
                                        <dd>
                                            <?= h($etudiant->cite_universiatire) ?>
                                        </dd>
                                                                                                                                                                                                            
                                            
                                                                        <dt><?= __('Code Adresse Fix') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($etudiant->code_adresse_fix)); ?>
                            </dd>
                                                    <dt><?= __('Adresse Fix Fr') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($etudiant->adresse_fix_fr)); ?>
                            </dd>
                                                    <dt><?= __('Adresse Fix Ar') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($etudiant->adresse_fix_ar)); ?>
                            </dd>
                                                    <dt><?= __('Adresse Annulle Fr') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($etudiant->adresse_annulle_fr)); ?>
                            </dd>
                                                    <dt><?= __('Adresse Annulle Ar') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($etudiant->adresse_annulle_ar)); ?>
                            </dd>
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title">Elements en cours</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($etudiant->etudiers)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                
                                        
                                                                    
                                    
                                        
                                                                    
                                    <th>
                                    Annee Scolaire Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Classe
                                    </th>
                                        
                                                                    
                                    <th>
                                    Element Id
                                    </th>
                                        
                                                                    
                                
                            </tr>

                            <?php foreach ($etudiant->etudiers as $etudiers): ?>
                                <tr>
                                                                        
                                    
                                    <td><?= h($etudiers->annee_scolaire_id) ?>
                                    </td>
                                                                        
                                    
                                                                        
                                    <td>
                                    <?= h($etudiers->groupe->niveau->libile . " " .$etudiers->groupe->filiere->libile ) ?>
                                    </td>
                                    <td>
                                    <?= h($etudiers->element->libile) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title">Certificats</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($etudiant->certificats)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type
                                    </th>
                                        
                                                                                                                                            
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($etudiant->certificats as $certificats): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($certificats->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($certificats->type) ?>
                                    </td>
                                                                                                            
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Certificats', 'action' => 'view', $certificats->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Certificats', 'action' => 'edit', $certificats->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Certificats', 'action' => 'delete', $certificats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $certificats->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
