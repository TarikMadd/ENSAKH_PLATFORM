<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Courriers Départ
      
       <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'addDepart1'], ['class'=>'btn btn-block btn-success']) ?></div>
        <div class="pull-right"><?= $this->Html->link(__('Rechercher'), ['action' => 'trierDepart'], ['class'=>'btn btn-block btn-primary ']) ?>
              
            </div>
      </h1>
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table de données</h3>
             
           

          <div class="box">
            <div class="box-header">
          
            </div>
            <!-- /.box-header -->
            <div class="ox-body table-responsive no-padding">
           
              <table id="example1" class="table table-hover">
                <thead>
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
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
              
                <?php for ($i=0;$i<count($courrierDepart);$i++ ): ?>
                        <tr>
                            <td><?= $this->Number->format($courrierDepart[$i]['id']) ?></td>
                            <td><?= h($courrierDepart[$i]['date_depart']) ?></td>
                            <td><?= h($courrierDepart[$i]['désignation']) ?></td>
                            <td>
                            <?= $this->Html->link($courrierDepart[$i]['nomComplet_destinataire'], ['controller' => 'Respobureauordres','action' => 'viewDest', $courrierDepart[$i]['destinataire_id']]) ?>
                            </td>
                            <td><?= h($courrierDepart[$i]['type_courrier']) ?></td>
                            <td><?= h($courrierDepart[$i]['service']) ?></td>
                            <td><?= h($courrierDepart[$i]['necessite']) ?></td>
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
         
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
        </div>

        <!-- /.col -->
      </div>
      <div  class="pull-left" >
      <?= $this->Form->postLink(__('Supprimer l\'archive'), ['action' => 'supprimerArchiveDepart'], ['confirm' => __('Confirmer la suppression de l\'archive?'), 'class'=>'btn btn-block btn-danger']) ?>
      </div>
      <div class="pull-left">
                  <?= $this->Form->postLink(__('Vider la table'), ['action' => 'miseAzeroDepart'], ['confirm' => __('Confirmer la mise à zero de la table ?'), 'class'=>'btn btn-block btn-danger']) ?>
                  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/datatables/jquery.dataTables.min',
  'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "order": [[ 1, "desc" ]],
        "info": false,
        "autoWidth": false,  
        "language": {
            "paginate": {
            "next": "Suivant",
            "previous": "Précédent",
            },
            "search": "Rechercher: ",
            "zeroRecords": "Aucun critère ne correspond à ce que vous avez tapé.",
            "emptyTable": "Rien à afficher.",
            "lengthMenu": "Afficher _MENU_ lignes"
        },
        buttons: [ 'copy', {
                  extend: 'exel',
                  exportOptions: {
                    columns: [0,1,2]
                  }
                  },'pdf','colvis']
    }
      );
    $("#example1").append(table.table().buttons);
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php $this->end(); ?>





