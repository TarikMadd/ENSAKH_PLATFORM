<section class="content-header">
  <h1>
    <?php echo __('BON DE COMMANDE'); 
      $bon = true;
      error_reporting(0);?>
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
                <h3 class="box-title"><?php echo __('Information Sur La Commande'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                            
                                            
                                                                                                                                            
                                        
                                                                    
                                                                        <dt><?= __('Nom Du Devis') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($devisdemande->nom_devis)); ?>
                            </dd>
                                                    <dt><?= __('Nom Du Fournisseur') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($devisdemande->nom_fournisseur)); ?>
                            </dd>
                                                    <dt><?= __('Adresse Du Fournisseur') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($devisdemande->adresse_fournisseur)); ?>
                            </dd>
                                                    <dt><?= __('Intitulé') ?></dt>
                            <dd>
                            <?= $this->Text->autoParagraph(h($devisdemande->intitule)); ?>
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
                    <h3 class="box-title"><?php echo __('Les Articles associées'); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($devisdemande->articleevents)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Réf
                                    </th>
                                        
                                                                    
                                    <th>
                                    Désigantion
                                    </th>
                                        
                                                                    
                                    <th>
                                    Quantité
                                    </th>
                                        
                                                                    
                                    <th>
                                    Prix Unitaire Ht
                                    </th>
                                        
                                                                    
                                    <th>
                                    Prix Du Lot Ht
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); $Totaux= array(); ?>
                                </th>
                            </tr>

                            <?php foreach ($devisdemande->articleevents as $articleevents): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($articleevents->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->desigantion)?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->quantite) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?php if(!isset($articleevents->prix_unitaire_ht)){
                                        $bon=false;
                                      } 
                                      echo h($articleevents->prix_unitaire_ht);?>
                                   
                                    </td>
                                                                        
                                    <td>
                                    <?php  if(isset($articleevents->prix_unitaire_ht)){
                                      array_unshift($Totaux, $articleevents->prix_unitaire_ht*$articleevents->quantite);
                                        echo $Totaux[0] ."  DHS";
                                      } ?>
                                    </td>
                                    
                                                                        <td class="actions">

                                    <?= $this->Html->link(__('Attribuer Prix'), ['controller' => 'Respofinances', 'action' => 'attribuerprix', $articleevents->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                      
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                          
                                    
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <tbody>
                         <tr>
                              <th><center>TVA</center></th><td>20%</td>
                            </tr>
                            <tr>
                              <th><center>PRIX TOTAL TTC</center></th><td><?php $Total= array_sum($Totaux)*120/100;
                              echo $Total . "  DHS" ?></td>
                            </tr>
                            </tbody></table>
                            
                <?php endif; ?>

                <div class="actions" align="right">
                                     <?= $this->Form->create($devisdemande, array('role' => 'form')) ?>
                                  <input type="hidden" name="bonbool" value=<?= '"'+$bon+'"' ?> />
                                     <input type="hidden" name="id" value=<?= '"'+$devisdemande->id+'"' ?> />
                                     <input type="hidden" name="total" value=<?= '"'+$Total+'"' ?> />
                                                 <?= $this->Form->button(__('Imprimer Bon De Commande')) ?>
                                                <?= $this->Form->end() ?>
                                    
                                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
   
</section>

