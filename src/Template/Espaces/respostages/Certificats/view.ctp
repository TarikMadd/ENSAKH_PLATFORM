<section class="content-header">
  <h1>
    <?php echo __('Certificat'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'indexCertificats'], ['escape' => false])?>
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
                <h3 class="box-title"><?php echo __('Informations'); ?></h3>
                 <?= $this->Html->link(__('Editer'), ['action' => 'editCertificats',$certificat->id], ['class'=>'fa fa-edit pull-right'] ,['escape' => false]) ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                        <dt><?= __('Id') ?></dt>
                                        <dd>
                                            <?= h($certificat->id) ?>
                                        </dd> 
                                        <dt><?= __('Type') ?></dt>
                                        <dd>
                                            <?= h($certificat->type) ?>
                                        </dd>  
                                        <dt><?= __('Nombre max') ?></dt>
                                        <dd>
                                            <?= h($certificat->nombre_max) ?>
                                        </dd> 
                                        <dt><?= __('Crée le') ?></dt>
                                        <dd>
                                            <?= h($certificat->created) ?>
                                        </dd> 
                                        <dt><?= __('Dernière modification') ?></dt>
                                        <dd>
                                            <?= h($certificat->modified) ?>
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
