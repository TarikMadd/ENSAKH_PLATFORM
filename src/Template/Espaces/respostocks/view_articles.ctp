<section class="content-header">
  <h1>
    <?php echo __('Article'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'index_articles'], ['escape' => false])?>
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

                <?php if (!empty($article->commande_articles)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Commande Id
                                    </th>
                                        
                                                                    

                                        
                                                                    
                                    <th>
                                    Description
                                    </th>
                                        
                                                                    
                                    <th>
                                    Article Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nombre Article
                                    </th>
                                        
                                                                    
                               
                            </tr>

                            <?php foreach ($article->commande_articles as $commandes): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($commandes->commande_id) ?>
                                    </td>
                                                                       
                                                                        
                                    <td>
                                    <?= h($commandes->description) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($commandes->article_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($commandes->quantite) ?>
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
                                    <?= $this->Html->link(__('Afficher'), ['controller' => 'Respostocks', 'action' => 'view_mouvements', $mouvements->id], ['class'=>'btn btn-info btn-xs']) ?>
 <?php if($mouvements->quantite_entree < $mouvements->quantite_sortie){ ?>
                                    <?= $this->Html->link(__('Editer'), ['controller' => 'Respostocks', 'action' => 'edit_mouvements', $mouvements->id], ['class'=>'btn btn-warning btn-xs']) ?>
<?php } ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Respostocks', 'action' => 'delete_mouvements', $mouvements->id], ['confirm' => __('Voulez vou vraiment le supprimer # {0}?', $mouvements->magasin_id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
