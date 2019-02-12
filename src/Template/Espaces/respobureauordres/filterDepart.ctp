


<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
  <h3 class="box-title"><?= __('Resultas de') ?> Recherche</h3>
  <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
  
              </div>
            </form>
  <ol class="breadcrumb">
    <li>
      <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('retour'), ['action' => 'trierDepart'], ['escape' => false]) ?>
    </li>
  </ol>
  
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        
 
 
 <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>

          
                <th><?= $this->Paginator->sort('Numéro Enregistrement') ?></th>
                <th><?= $this->Paginator->sort('date_départ') ?></th>
                <th><?= $this->Paginator->sort('désignation') ?></th>
                <th><?= $this->Paginator->sort('destinataire_id') ?></th>
                <th><?= $this->Paginator->sort('type_courrier') ?></th>
                <th><?= $this->Paginator->sort('service') ?></th>
                <th><?= $this->Paginator->sort('nécessité d\'accusé') ?></th>
                <th><?= $this->Paginator->sort('état_courrier') ?></th>
                <th><?= $this->Paginator->sort('courrier') ?></th>
                <th><?= $this->Paginator->sort('accusé') ?></th>

               
              <th><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
    
             <?php for ($i=0;$i<count($courrierDepart);$i++ ): ?>
              <tr>
                <td><?= h($courrierDepart[$i]['id']) ?></td>
                <td><?= h($courrierDepart[$i]['date_depart']) ?></td>
                <td><?= h($courrierDepart[$i]['désignation']) ?></td>
                <td> <?= h($courrierDepart[$i]['nomComplet_destinataire']) ?> </td>
                <td><?= h($courrierDepart[$i]['type_courrier']) ?></td>
                <td><?= h($courrierDepart[$i]['service']) ?></td>
                <td><?= h($courrierDepart[$i]['necessite']) ?></td>
                <td><?= h($courrierDepart[$i]['etat_courrier']) ?></td>
                <?php 
                            if(h($courrierDepart[$i]['etat_courrier']) != "*") 
                            { echo'<td> 
                <span class="badge bg-yellow" >';?> <?= h($courrierDepart[$i]['etat_courrier']) ?> 
                <?php echo '</span></td>'; }
                else{?>
                            <td><?= h($courrierDepart[$i]['etat_courrier']) ?></td>

                 <?php }?>
                            <td><a href="<?php echo $this->Url->build('/uploads/files/'.h($courrierDepart[$i]['courrier']).''); ?>" target="_blank" class="btn btn-info btn-xs">afficher</a></td>
                            <?php if(h($courrierDepart[$i]['necessite']) == "Non") {?>
                            <td><?= h($courrierDepart[$i]['accuse']) ?></td>
                            <?php }else{
                                    if(h($courrierDepart[$i]['etat_courrier']) == "en attente"){?>
                                    <td><?= h($courrierDepart[$i]['accuse']) ?></td>
                                    <?php }
                                    if(h($courrierDepart[$i]['etat_courrier']) == "courrier reçu"){?>
                                    <td><a href="<?php echo $this->Url->build('/uploads/files/'.h($courrierDepart[$i]['accuse']).''); ?>" target="_blank" class="btn btn-info btn-xs">afficher</a></td>
                                  <?php }
                                  if(h($courrierDepart[$i]['etat_courrier']) == "courrier non reçus"){?>
                                   <td><?echo "-"; ?></td>
                                  <?php }} ?>
                            <?php if(h($courrierDepart[$i]['etat_courrier']) == "courrier non reçus") {?>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Information'), ['action' => 'viewDepart1', $courrierDepart[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteDepart1', $courrierDepart[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            <?php }elseif(h($courrierDepart[$i]['etat_courrier']) == "en attente"){?>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('approuver'), ['action' => 'approuver', $courrierDepart[$i]['id']], ['class'=>'btn btn-primary btn-xs']) ?>
                                    <?= $this->Html->link(__('Voir'), ['action' => 'viewDepart1', $courrierDepart[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editDepart1', $courrierDepart[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteDepart1', $courrierDepart[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            <?php }else{?>
                                   <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Voir'), ['action' => 'viewDepart1', $courrierDepart[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editDepart1', $courrierDepart[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteDepart1', $courrierDepart[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            <?php }?>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
  
 
</div>
</section>




