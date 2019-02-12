
<section class="content-header">
  <h1>
    <?php echo __('Magasin'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'index'], ['escape' => false])?>
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
                                                                                                                <dt><?= __('Nom Magasin') ?></dt>
                                        <dd>
                                            <?= h($magasin->nom_magasin) ?>
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
                    <h3 class="box-title"><?= __('Related {0}', ['Mouvements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($magasin->mouvements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Article Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Magasin Id
                                    </th>
                                        
                                                                    
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
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($magasin->mouvements as $mouvements): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($mouvements->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->article_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($mouvements->magasin_id) ?>
                                    </td>
                                                                        
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
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('Afficher'), ['controller' => 'Mouvements', 'action' => 'view', $mouvements->id], ['class'=>'btn btn-info btn-xs']) ?>

                                     <?php if($mouvements->quantite_entree < $mouvements->quantite_sortie){ ?>
                                    <?= $this->Html->link(__('Editer'), ['controller' => 'Respostocks', 'action' => 'edit_mouvements', $mouvements->id], ['class'=>'btn btn-warning btn-xs']) ?>
<?php } ?>

                                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Mouvements', 'action' => 'delete_mouvements', $mouvements->id], ['confirm' => __('Voulez vous vraiment le supprimer  # {0}?', $mouvements->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
