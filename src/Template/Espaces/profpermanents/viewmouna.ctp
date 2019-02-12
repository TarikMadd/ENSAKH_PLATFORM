<section class="content-header">
  <h1>
    <?php echo __('Vos Données'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>
<!--mouna jellouli-->
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
                <dl class="dl-horizontal">
                                 <dt><?= __('Nom :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->nom_prof) ?>
                                        </dd>
                                      <dt><?= __('Prénom :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->prenom_prof) ?>
                                        </dd>
                                           <dt><?= __(' Numéro de somme  :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->somme) ?>
                                        </dd>
                                          <dt><?= __('Poste :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->poste) ?>
                                        </dd>
                                          <dt><?= __('Numéro de téléphone :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->phone) ?>
                                </dd>
                                  <dt><?= __('Email :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->email_prof) ?>
                                </dd>
                                     
                                           <dt><?= __('Diplome :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->diplome) ?>
                                        </dd>
                                             <dt><?= __('Specialité :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->specialite) ?>
                                        </dd>
                                              <dt><?= __('Situation Familiale :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->situation_familiale) ?>
                                        </dd>
                                            <dt><?= __('Lieu de naissance :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->Lieu_Naissance) ?>
                                        </dd>
                        
                                            
                                         
                                    <dt><?= __('Echèlle :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->echelle) ?>
                                </dd>
                                <dt><?= __('Echelon :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->echelon) ?>
                                </dd>
                         <dt><?= __('Etat :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->etat) ?>
                                </dd>
                              <dt><?= __('Age :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->age) ?>
                                </dd>
                                <dt><?= __('Code Situation Admin :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->code_situation_admin) ?>
                                </dd>
                             <dt><?= __('Code établissement :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->codeEtablissement) ?>
                                </dd>
                                                <dt><?= __('CIN :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->CIN) ?>
                                </dd>
                                                                                                
                                        <dt><?= __('Date  de recrutement :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->date_Recrut) ?>
                                </dd>
                                        <dt><?= __('Date de naissance :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->dateNaissance) ?>
                                </dd>
                                                                                                    
                                            
                                    <dt><?= __('Universite :') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($profpermanent->universite)); ?>
                            </dd>
                                    <dt><?= __('Autres diplomes :') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($profpermanent->autresdiplomes)); ?>
                            </dd>
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <form action="<?= $this->Url->build(); ?>" method="post">
            <?php   // user is logged in, show logout..user menu etc
            echo $this->Html->link('Modifier vos données', array('controller' => 'profpermanents', 'action' => 'editmouna'),['class' => 'btn btn-danger btn-block']);
            ?>
     <!-- <span>    <input      name="modifier" type="submit" value="modifier vos données"   class="pull-right" class="btn btn-info btn-flat"></span>-->
        </form>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>
