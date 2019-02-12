<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Commandes
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des commandes</h3>
           

          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body">
           
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('delai_limite') ?></th>
              <th><?= $this->Paginator->sort('nom') ?></th>
              <th><?= $this->Paginator->sort('stock categorie') ?></th>
              <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
              
                <?php for($i=0;$i<count($commande);$i++): ?>
              <tr>
                <td><?= h($commande[$i]['id']) ?></td>
                <td><?= h($commande[$i]['delai_limite']) ?></td>
                <td><?= h($commande[$i]['nom']) ?></td>
                <td><?= h($commande[$i]['label_cat']) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('détails'), ['action' => 'viewCommandes', $commande[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('ajouter article'), [ 'action' => 'addCA', $commande[$i]['id']], ['class'=>'btn btn-xs bg-maroon']) ?>
                  <?= $this->Html->link(__('imprimer liste'), ['action' => 'liste', $commande[$i]['id']], ['class'=>'btn btn-primary btn-xs']) ?>
                  <?= $this->Html->link(__('imprimer commande'), ['action' => 'comCom', $commande[$i]['id']], ['class'=>'btn btn-xs bg-maroon']) ?>
                  <?= $this->Html->link(__(''), ['action' => 'editCommandes', $commande[$i]['id']], ['class'=>'fa fa-edit']) ?>
                  <?= $this->Form->postLink(__(''), ['action' => 'deleteCommandes', $commande[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'fa fa-trash-o']) ?>
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
