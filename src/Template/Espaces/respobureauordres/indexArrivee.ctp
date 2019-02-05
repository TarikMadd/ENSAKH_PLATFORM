<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Courriers Reçus
      
       <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'addArrivee'], ['class'=>'btn btn-block btn-success']) ?></div>
        <div class="pull-right"><?= $this->Html->link(__('Rechercher'), ['action' => 'trierArrivee'], ['class'=>'btn btn-block btn-primary ']) ?>
              
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
              <th><?= $this->Paginator->sort('Numéro enregistrement') ?></th>
              <th><?= $this->Paginator->sort('date_arrivée') ?></th>
              <th><?= $this->Paginator->sort('Désignation') ?></th>
              <th><?= $this->Paginator->sort('expéditeur_id') ?></th>
              <th><?= $this->Paginator->sort('nom_service') ?></th>

              <th><?= $this->Paginator->sort('type_courrier') ?></th>
              <th><?= $this->Paginator->sort('nécessité_du_traitement') ?></th>

              <th><?= $this->Paginator->sort('Priorité') ?></th>
              <th><?= $this->Paginator->sort('date_limite_du_traitement') ?></th>
               <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= $this->Paginator->sort('Courrier') ?></th>
              <th><?= $this->Paginator->sort('Accusé de réception') ?></th>
              <th><?= $this->Paginator->sort('Courrier_retourne') ?></th>
              <th>Actions</th>
              
                </tr>
                </thead>
                <tbody>
              
                 <?php for ($i=0;$i<count($courrierArrivee);$i++ ): ?>
              <tr>
                <td><?= h($courrierArrivee[$i]['id']) ?></td>
                <td><?= h($courrierArrivee[$i]['date_arrivee']) ?></td>
                <td><?= h($courrierArrivee[$i]['Désignation']) ?></td>
                <td>
                  <?= $this->Html->link($courrierArrivee[$i]['nomComplet_expediteur'], ['controller' => 'Expediteurs','action' => 'view', $courrierArrivee[$i]['expediteur_id']]) ?>
                </td>
                <?php if($courrierArrivee[$i]['service_id']!=NULL): ?>
                  <td> <?= h($services[$courrierArrivee[$i]['service_id']]) ?> </td>
                <?php else: ?>
                  <td> <?php echo"-"; ?></td>
                
                <?php endif; ?>

                <td><?= h($courrierArrivee[$i]['type_courrier']) ?></td>
                <td><?= h($courrierArrivee[$i]['necessité_du_traitement']) ?></td>

                <?php if( h($courrierArrivee[$i]['Priorité'])=="Urgent")
                { echo'<td> 
                <span class="badge bg-yellow" >';?> <?= h($courrierArrivee[$i]['Priorité']) ?> 
                <?php echo '</span></td>'; }
                elseif (h($courrierArrivee[$i]['Priorité'])=="Normal") 
                {
                 echo'<td> <span class="badge bg-green" >';?> <?= h($courrierArrivee[$i]['Priorité']) ?><?php echo '</span></td>'; }
                elseif (h($courrierArrivee[$i]['Priorité'])=="aucun") 
                {
                 echo'<td> </td>'; }
                 elseif (h($courrierArrivee[$i]['Priorité'])=="Très urgent")
                {
                echo' <td> <span class="badge bg-red" >'; ?> <?= h($courrierArrivee[$i]['Priorité']) ?><?php echo '</span></td>'; }
                else{
                  echo' <td> '; ?> <?= h($courrierArrivee[$i]['Priorité']) ?><?php echo '</td>'; 
                }
                  
                ?>


                
  
                
                <td><?= h($courrierArrivee[$i]['date_limite_du_traitement']) ?></td>
                <?php if( h($courrierArrivee[$i]['etat_du_courrier'])!="-")
                { echo'<td> 
                <span class="badge bg-yellow" >';?> <?= h($courrierArrivee[$i]['etat_du_courrier']) ?> 
                <?php echo '</span></td>'; }
                else echo'<td>'. h($courrierArrivee[$i]['etat_du_courrier']) .'</td>';

                 ?>
                <td class="actions" style="white-space:nowrap">
                <?php if($courrierArrivee[$i]['courrier']!=""): ?> 
                  <?= $this->Html->link(__('Télécharger'), ['action' => 'download', $courrierArrivee[$i]['id']], ['class'=>'fa fa-download']) ?>

                
                   <a href="<?php echo $this->Url->build('/courrier/'.$courrierArrivee[$i]['courrier'].''); ?>" target="_blank" class="btn bg-navy margin">afficher</a>
               <?php endif;?>
                </td>
                <td class="actions" style="white-space:nowrap">
                <?php if($courrierArrivee[$i]['accuse']!=""): ?> 
                  <?= $this->Html->link(__('Télécharger'), ['action' => 'downloadAcc', $courrierArrivee[$i]['id']], ['class'=>'fa fa-download']) ?>
                  <a href="<?php echo $this->Url->build('/courrier/'.$courrierArrivee[$i]['accuse'].''); ?>" target="_blank" class="btn bg-navy margin">afficher</a>
                   <?php endif;?>
                </td>
                <?php if( h($courrierArrivee[$i]['courrier_retourne']) =="Oui")
                { echo'<td> 
                <span class="badge bg-red" >';?> <?= h($courrierArrivee[$i]['courrier_retourne']) ?> 
                <?php echo '</span></td>'; }
                else echo'<td>'. h($courrierArrivee[$i]['courrier_retourne']) .'</td>';

                 ?>
                <td class="actions" style="white-space:nowrap">
                <p>
                <span style="inline;">
                   <?php if($courrierArrivee[$i]['etat_du_courrier'] =="en attente"): ?>
                <form action="<?= $this->Url->build(['action'=>'updateEtat', $courrierArrivee[$i]['id']]); ?>" method="post">
                  
                  <input class="btn btn-primary btn-xs" name="editer" value="Approuver" type="submit">
                  
                    </form>
                    <?php endif;?>
                    <?php if($courrierArrivee[$i]['etat_du_courrier'] =="en cours de traitement"): ?>
                <form action="<?= $this->Url->build(['action'=>'updateEtat', $courrierArrivee[$i]['id']]); ?>" method="post">
                  
                  <input class="btn btn-success btn-xs" name="editer" value="Valider" type="submit">
                  
                    </form>
                    <?php endif;?>
                  
                  <?= $this->Html->link(__('Voir'), ['action' => 'viewArrivee', $courrierArrivee[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Editer'), ['action' => 'editArrivee', $courrierArrivee[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteArrivee', $courrierArrivee[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                  </span>
                  </p>
                  
                </td>
                
                
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
      <?= $this->Form->postLink(__('Supprimer l\'archive'), ['action' => 'supprimerArchiveArrivee'], ['confirm' => __('Confirmer la suppression de l\'archive?'), 'class'=>'btn btn-block btn-danger']) ?>
      </div>
      <div class="pull-left">
                  <?= $this->Form->postLink(__('Vider la table'), ['action' => 'miseAzeroArrivee'], ['confirm' => __('Confirmer la mise à zero de la table ?'), 'class'=>'btn btn-block btn-danger']) ?>
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
        "order": [[ 2, "desc" ]],
        "info": false,
        "autoWidth": true,  
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
    });
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

