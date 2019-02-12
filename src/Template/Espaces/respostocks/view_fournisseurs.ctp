<section class="content-header">
  <h1>
    <?php echo __('Fournisseur'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index_fournisseurs'], ['escape' => false])?>
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
                                                                                                        <dt><?= __('Stock Category') ?></dt>
                                <dd>
                                    <?= $fournisseur->has('stock_category') ? $fournisseur->stock_category->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Nom Fournisseur') ?></dt>
                                        <dd>
                                            <?= h($fournisseur->nom_fournisseur) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Fournisseur') ?></dt>
                                        <dd>
                                            <?= h($fournisseur->prenom_fournisseur) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Label Fournisseur') ?></dt>
                                        <dd>
                                            <?= h($fournisseur->label_fournisseur) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                            
                                            
                                                                        <dt><?= __('Adresse') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($fournisseur->adresse)); ?>
                            </dd>
                                                    <dt><?= __('Email') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($fournisseur->email)); ?>
                            </dd>
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>

</section>
