<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Expéditeurs
    <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'AjouterExpediteur'], ['class'=>'btn btn-block btn-success']) ?></div>
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
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('nomComplet_expéditeur') ?></th>
              <th><?= $this->Paginator->sort('adresse_expéditeur') ?></th>
              <th><?= $this->Paginator->sort('email_expéditeur') ?></th>
              <th><?= $this->Paginator->sort('téléphone_expéditeur') ?></th>
              <th><?= $this->Paginator->sort('ville_expéditeur') ?></th>
              <th><?= $this->Paginator->sort('pays_expéditeur') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
                </thead>
                <tbody>
              
                 <?php foreach ($Expediteurs as $Expediteurs): ?>
            <tr>
      
      
       <td> <?php echo $Expediteurs['id']; ?> </td>
             <td> <?php echo $Expediteurs['nomComplet_expediteur'];?> </td>
             <td><?php echo $Expediteurs['adresse_expediteur']; ?></td>
             <td><?php echo $Expediteurs['email_expediteur'];?></td>
             <td><?php echo "0".$Expediteurs['telephone_expediteur']; ?></td>
             <td><?php echo $Expediteurs['ville_expediteur']; ?></td>
             <td><?php echo $Expediteurs['pays_expediteur']; ?></td>

                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Editer'), ['action' => 'Azzouzi_editexpediteur', $Expediteurs->id], ['class'=>'btn btn-warning btn-xs']) ?>


                  

                  <?= $this->Html->link(__('Voir'), ['action' => 'viewExpediteur', $Expediteurs->id], ['class'=>'btn btn-info btn-xs']) ?>
            
                  <?= $this->Form->postLink(__('supprimer'), ['action' => 'Azzouzi_supprimerexpediteur', $Expediteurs->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
         
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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

