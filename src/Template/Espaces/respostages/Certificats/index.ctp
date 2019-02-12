<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Certificats
       <div class="pull-right"><?= $this->Html->link(__(''), ['action' => 'addCertificats'], ['class'=>'btn fa fa-plus btn-success btn-xs']) ?></div>
      </h1>
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table de donnees</h3>
           

          <div class="box">
            <div class="box-header">
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Type</th>
                  <th>Nombre maximale</th>
                  <th>Actions</th>
              
                </tr>
                </thead>
                <tbody>
              
                 <?php for($i=0;$i<count($certificats);$i++): ?>
                <tr>
                <td><?= h($certificats[$i]['id']) ?></td>
                <td><?= h($certificats[$i]['type']) ?></td>
                <?php if(h($certificats[$i]['nombre_max'])>1000): ?>
                <td> <?php echo "-"; ?> </td>
                 <?php else: ?>
                <td> <?= h($certificats[$i]['nombre_max']) ?> </td>
                <?php endif; ?>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewCertificats', $certificats[$i]['id']], ['class'=>'btn btn-info btn-xs'] )?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'editCertificats', $certificats[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteCertificats', $certificats[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
    $("#example1").DataTable();
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
