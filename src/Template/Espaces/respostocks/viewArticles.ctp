<section class="content-header">
  <h1>
    <?php echo __('Article'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
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
                                    <?= $article->has('stock_category') ? $article->stock_category->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Label Article') ?></dt>
                                        <dd>
                                            <?= h($article->label_article) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Marque') ?></dt>
                                        <dd>
                                            <?= h($article->marque) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Quantite Min') ?></dt>
                                <dd>
                                    <?= $this->Number->format($article->quantite_min) ?>
                                </dd>
                                                                                                                <dt><?= __('Quantite') ?></dt>
                                <dd>
                                    <?= $this->Number->format($article->quantite) ?>
                                </dd>
                                                                                                
                                            
                                                                        <dt><?= __('Utilite') ?></dt>
                            <dd>
                            <?= $article->utilite ? __('Yes') : __('No'); ?>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Commandes']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($article->commandes)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Fournisseur Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Cree
                                    </th>
                                        
                                                                    
                                    <th>
                                    Article Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nbr Article
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($article->commandes as $commandes): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($commandes->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($commandes->fournisseur_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($commandes->cree) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($commandes->article_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($commandes->nbr_article) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Commandes', 'action' => 'view', $commandes->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Commandes', 'action' => 'edit', $commandes->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Commandes', 'action' => 'delete', $commandes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $commandes->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Mouvements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($article->mouvements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Date Mouvement
                                    </th>
                                        
                                                                    
                                    <th>
                                    Reference Entree
                                    </th>
                                        
                                                                    
                                    <th>
                                    Reference Sortie
                                    </th>
                                        
                                                                    
                                    <th>
                                    Quantite Entree
                                    </th>
                                        
                                                                    
                                    <th>
                                    Quantite Sortie
                                    </th>
                                        
                                                                    
                                    <th>
                                    Service
                                    </th>
                                        
                                                                    
                                    <th>
                                    Magasin Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Article Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($article->mouvements as $mouvements): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($mouvements->date_mouvement) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->reference_entree) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->reference_sortie) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->quantite_entree) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->quantite_sortie) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->service) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->magasin_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->article_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Mouvements', 'action' => 'view', $mouvements->magasin_id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Mouvements', 'action' => 'edit', $mouvements->magasin_id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Mouvements', 'action' => 'delete', $mouvements->magasin_id], ['confirm' => __('Are you sure you want to delete # {0}?', $mouvements->magasin_id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
