<section class="content-header">
  <h1>
    <?php echo __('Photo'); ?>
</h1>
<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'afficherImages'], ['escape' => false])?>
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
                    <dt><?= __('Photo') ?></dt>
                        <dd>
                            <?= h($image->lien) ?>
                        </dd>
                        <dt><?= __('Commentaire') ?></dt>
                        <dd>
                            <?= h($image->commentaire) ?>
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
