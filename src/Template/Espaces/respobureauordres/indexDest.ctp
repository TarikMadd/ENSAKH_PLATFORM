<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Destinataires
        <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'addDest'], ['class'=>'btn btn-success btn-xs']) ?></div>
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
                                    <th><?= $this->Paginator->sort('nomComplet_destinataire') ?></th>
                                    <th><?= $this->Paginator->sort('adresse_destinataire') ?></th>
                                    <th><?= $this->Paginator->sort('email_destinataire') ?></th>
                                    <th><?= $this->Paginator->sort('téléphone_destinataire') ?></th>
                                    <th><?= $this->Paginator->sort('ville_destinataire') ?></th>
                                    <th><?= $this->Paginator->sort('pays_destinataire') ?></th>
                                    <th><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($Destinataires as $destinataire): ?>
                                    <tr>


                                        <td> <?php echo $destinataire['id']; ?> </td>
                                        <td><?php echo $destinataire['nomComplet_destinataire'];?></td>
                                        <td><?php echo $destinataire['adresse_destinataire'];?></td>
                                        <td><?php echo $destinataire['email_destinataire'];?></td>
                                        <td><?php echo $destinataire['telephone_destinataire'];?></td>
                                        <td><?php echo $destinataire['ville_destinataire'];?></td>
                                        <td><?php echo $destinataire['pays_destinataire'];?></td>

                                        <td class="actions" style="white-space:nowrap">
                                            <?= $this->Html->link(__('Voir'), ['action' => 'viewDest', $destinataire->id], ['class'=>'btn btn-info btn-xs']) ?>
                                            <?= $this->Html->link(__('Modifier'), ['action' => 'editDest', $destinataire->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteDest', $destinataire->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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



