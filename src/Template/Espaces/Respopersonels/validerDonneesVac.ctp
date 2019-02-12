<section class="content-header">
    <h1>
        <?php echo __('Les données de professeur '); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'validerDonneesVac'], ['escape' => false])?>
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
                            <?php echo $profvacbis[0]['nom_vacataire'] ?>
                        </dd>
                        <dt><?= __('Prénom') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['prenom_vacataire'] ?>
                        </dd>
                        <dt><?= __('Somme') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['somme'] ?>
                        </dd>
                        <dt><?= __('nombres des heures') ?></dt>
                        <dd>
                            <?php  echo $profvacbis[0]['nb_heures'] ?>
                        </dd>
                        <dt><?= __('Echelle') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['echelle'] ?>
                        </dd>
                        <dt><?= __('Echelon') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['echelon'] ?>
                        </dd>
                        

                        <dt><?= __('Diplome') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['diplome'] ?>
                        </dd>
                        <dt><?= __('Specialité') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['specialite'] ?>
                        </dd>
                        <dt><?= __('Université') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['universite'] ?>
                        </dd>
                        <dt><?= __('Date de recrutement ') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['dateRecrut'] ?>
                        </dd>
                        <dt><?= __('CIN') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['CIN'] ?>
                        </dd>
                        <dt><?= __('Situation familiale') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['situationFamiliale'] ?>
                        </dd>
                        
                        <dt><?= __('Date de naissance') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['dateNaissance'] ?>
                        </dd>
                        <dt><?= __('Lieu de naissance') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['LieuNaissance'] ?>
                        </dd>
                        
                        <dt><?= __('Email') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['email'] ?>
                        </dd>

                        <dt><?= __('Nombre d\'enfants') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['nbr_enfants'] ?>
                        </dd>

                        <dt><?= __('Genre') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['genre'] ?>
                        </dd>

                        <dt><?= __('Age') ?></dt>
                        <dd>
                            <?php echo $profvacbis[0]['age'] ?>
                        </dd>
                        
                      <div class="col-md-1 pull-right" >
                      <button class="btn btn-block btn-success" name="save"> valider</button>
                      </div>
 <?php echo $this->form->end();?>


                     





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
