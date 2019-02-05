<section class="content-header">
  <h1>
    <?php echo __('Mouvement'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'index_mouvements'], ['escape' => false])?>
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
                                                                                                                <dt><?= __('Reference Entree') ?></dt>
                                        <dd>
                                            <?= h($mouvement->reference_entree) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Reference Sortie') ?></dt>
                                        <dd>
                                            <?= h($mouvement->reference_sortie) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Service') ?></dt>
                                        <dd>
                                            <?= h($mouvement->service) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Magasin') ?></dt>
                                <dd>
                                    <?= $mouvement->has('magasin') ? $mouvement->magasin->id : '' ?>
                                </dd>
                                                                                                                <dt><?= __('Article') ?></dt>
                                <dd>
                                    <?= $mouvement->has('article') ? $mouvement->article->id : '' ?>
                                </dd>
                                                                                                
                                            
                                                                                                        <dt><?= __('Quantite Entree') ?></dt>
                                <dd>
                                    <?= $this->Number->format($mouvement->quantite_entree) ?>
                                </dd>
                                                                                                                <dt><?= __('Quantite Sortie') ?></dt>
                                <dd>
                                    <?= $this->Number->format($mouvement->quantite_sortie) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('Date Mouvement') ?></dt>
                                <dd>
                                    <?= h($mouvement->date_mouvement) ?>
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
