<section class="content-header">
  <h1>
    <?php echo __('Infos Supplémentaires'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerProfsParDepar'], ['escape' => false])?>
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
                 <dd>
                   <?php echo $this->Html->image($professeur->photo, array('class' => 'img-circle', 'alt' => 'User Image')); ?>
                                                        </dd>

                                         <dt><?= __('Nom') ?></dt>

                                        <dd>
                                            <?= h($professeur->nom_prof) ?>
                                        </dd>
                                        <dt><?= __('Prénom') ?></dt>
                                        <dd>
                                            <?= h($professeur->prenom_prof) ?>
                                        </dd>
                                        <dt><?= __('Département') ?></dt>
                                         <dd>
                                            <?= h($departement->nom_departement) ?>
                                         </dd>
                                         <dt><?= __('Date Affectation') ?></dt>
                                         <dd>
                                          <?= h($profdepar->Date_Debut) ?>
                                         </dd>
                                         <dt><?= __('Poste Occupé') ?></dt>
                                         <dd>
                                         <?= h($profdepar->Poste_Filiere)?>
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

</section>
