
<section class="content-header">
  <h1>
    <?php
    use Cake\I18n\Time;
     echo __('Vos Données');
     ?>
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
                                            <?= h($profpermanent->nom_vacataire) ?>
                                        </dd>
                                      <dt><?= __('Prénom :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->prenom_vacataire) ?>
                                        </dd>
                                           <dt><?= __(' Numéro de somme  :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->somme) ?>
                                        </dd>
                                           <dt><?= __(' Nombre d\'heures  :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->nb_heures) ?>
                                        </dd>
                                          
                                          
                                  <dt><?= __('Email :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->email) ?>
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
                                            <?= h($profpermanent->situationFamiliale) ?>
                                        </dd>
                                            <dt><?= __('Lieu de naissance :') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->LieuNaissance) ?>
                                        </dd>
                        
                                            
                                         
                                    
                        
                              <dt><?= __('Age :') ?></dt>
                                <dd>
                                    <?= $this->Number->format($profpermanent->age) ?>
                                </dd>
                                
                             
                                 <dt><?= __('CIN :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->CIN) ?>
                                </dd>
                                                                                                
                                        <dt><?= __('Date  de recrutement :') ?></dt>
                                <dd>
                                    <?= Time::parse($profpermanent->dateRecrut)->nice('Europe/Paris', 'fr-FR') ?>
                                </dd>
                                        <dt><?= __('Date  de affectation :') ?></dt>
                                <dd>
                                    <?= Time::parse($profpermanent->dateAffectation)->nice('Europe/Paris', 'fr-FR') ?>
                                </dd>
                                        <dt><?= __('Date de naissance :') ?></dt>
                                <dd>
                                    <?= Time::parse($profpermanent->dateNaissance)->nice('Europe/Paris', 'fr-FR') ?>
                                </dd>
                                <dt><?= __('Nombre Enfants :') ?></dt>
                                <dd>
                                    <?= h($profpermanent->nbr_enfants) ?>
                                </dd>
                                                                                                    
                                            
                                    <dt><?= __('Universite :') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($profpermanent->universite)); ?>
                            </dd>
                         
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <form action="<?= $this->Url->build(); ?>" method="post">
   
     <!-- <span>    <input      name="modifier" type="submit" value="modifier vos données"   class="pull-right" class="btn btn-info btn-flat"></span>-->
     <?php   // user is logged in, show logout..user menu etc
            echo $this->Html->link('Modifier vos données', array('controller' => 'profvacataires', 'action' => 'editmouna'),['class' => 'btn btn-success btn-block']);
            ?>
        </form>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>
