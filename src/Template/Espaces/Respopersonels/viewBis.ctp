<section class="content-header">
  <h1>
    <?php echo __('Infos Supplémentaires'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerAbsencesFonctionnaires'], ['escape' => false])?>
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
                                         <dt><?= __('ID fonctionnaire') ?></dt>
                                        <dd>
                                            <?= h($fonctionnaireAbsences->fonctionnaire_id) ?>
                                        </dd>
                                            <dt><?= __('nom fonctionnaire') ?></dt>
                                         <dd>
                                            <?= h($fonctionnaires->nom_fct) ?>
                                         </dd>
                                         <dt><?= __('nombre absence') ?></dt>
                                         <dd>
                                          <?= h($absences->nbr_absence) ?>
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
