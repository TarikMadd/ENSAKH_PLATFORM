<section class="content-header">
  <h1>
    <?php echo __('Commande'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index_commandes'], ['escape' => false])?>
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
                                                                                                        <dt><?= __('Fournisseur') ?></dt>
                                <dd>
                                    <?= $commande->has('fournisseur') ? $commande->fournisseur->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Article') ?></dt>
                                <dd>
                                    <?= $commande->has('article') ? $commande->article->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                                            <dt><?= __('Nbr Article') ?></dt>
                                <dd>
                                    <?= $this->Number->format($commande->nbr_article) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Cree') ?></dt>
                                <dd>
                                    <?= h($commande->cree) ?>
                                </dd>
								<dt><?= __('Desciption') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($commande->desciption)); ?>
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
