<section class="content-header">
    <h1>
        <?php echo __('Les données de professeur '); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'validerDonnees'], ['escape' => false])?>
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
                    <dl class="dl-horizontal">
                    <?php echo $this->form->create(); ?>
                        <dt><?= __('Nom') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['nom_prof'] ?>
                        </dd>
                        <dt><?= __('Prénom') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['prenom_prof'] ?>
                        </dd>
                        <dt><?= __('CIN') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['CIN'] ?>
                        </dd>
                        
                        
                        <dt><?= __('Etat') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['etat'] ?>
                        </dd>
                         <dt><?= __('date de recrutement') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['date_Recrut'] ?>
                        </dd>
                        <dt><?= __('Age') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['age'] ?>
                        </dd>

                        <dt><?= __('Diplome') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['diplome'] ?>
                        </dd>
                        <dt><?= __('Specialité') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['specialite'] ?>
                        </dd>
                        <dt><?= __('Université') ?></dt>
                        <dd>
                           
                            <?php echo $profpermabis[0]['universite'] ?>
                        </dd>
                        <dt><?= __('Autres diplomes') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['autresdiplomes'] ?>
                        </dd>
                        <dt><?= __('Situation familiale') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['situation_familiale'] ?>
                        </dd>
                        
                        
                        <dt><?= __('Lieu de naissance') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['Lieu_Naissance'] ?>
                        </dd>
                        <dt><?= __('Téléphone') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['phone'] ?>
                        </dd>
                        <dt><?= __('Email') ?></dt>
                        <dd>
                            <?php echo $profpermabis[0]['email_prof'] ?>
                        </dd>
                        
                      <div class="col-md-2 pull-right" >
                      <button class="btn btn-block btn-success" name="save">valider</button>
                      </div>
 <?php echo $this->form->end();?>


                       <!--<?= $this->Form->button(__('Save')) ?>-->





                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->

</section>
