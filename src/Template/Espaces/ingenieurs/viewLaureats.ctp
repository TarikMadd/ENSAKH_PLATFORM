<section class="content-header">
  <h1>
    <?php echo __('Laureat'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'afficherLaureats'], ['escape' => false])?>
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
                                                                                                                <dt><?= __('Nom') ?></dt>
                                        <dd>
                                            <?= h($laureat->nom) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom') ?></dt>
                                        <dd>
                                            <?= h($laureat->prenom) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Promotion') ?></dt>
                                        <dd>
                                            <?= h($laureat->promotion) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('SecteurTravail') ?></dt>
                                        <dd>
                                            <?= h($laureat->secteurTravail) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                        <dt><?= __('DateTravail') ?></dt>
                                <dd>
                                    <?= h($laureat->dateTravail) ?>
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
