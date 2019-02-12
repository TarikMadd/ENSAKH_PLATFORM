<section class="content-header">
  <h1>
    <?php echo __('Commande'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'indexCommandes'], ['escape' => false])?>
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
                                                                                                                <dt><?= __('Nom') ?></dt>
                                        <dd>
                                            <?= h($atest[0]['nom']) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Stock Categorie') ?></dt>
                                <dd>
                                    <?= $atest[0]['label_cat'] ?>
                                </dd>
                                                                                                
                                            
                                                                                                                                            
                                                                                                        <dt><?= __('Date Limite') ?></dt>
                                <dd>
                                    <?= h($atest[0]['delai_limite']) ?>
                                </dd>
                                                                                                    
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
            <div class="box-header">
            <!-- /.box-header --><?= $this->Html->link(__('ajouter article'), [ 'action' => 'addCA', $atest[0]['id']], ['class'=>'btn btn-xs bg-maroon']) ?>
            <div class="box-body">
<div class="box-body table-responsive no-padding">
                <h3 class="box-title"><?php echo __('Article commandé'); ?></h3>
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('article') ?></th>
              <th><?= $this->Paginator->sort('quantite') ?></th>
              <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                        <?php $i=0;  ?>
               <?php foreach ($comm as $comm): ?>
              <tr>
                <td><?= $this->Number->format($comm['id']) ?></td>
           <td><?= ($var[$i][0]['label_article']) ?></td>
            <?php $i++;  ?> 
                <td><?= $this->Number->format($comm['quantite']) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Designation'), ['action' => 'viewCA', $comm['id']], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__(''), ['action' => 'editCA', $comm['id']], ['class'=>'fa fa-edit']) ?>
                  <?= $this->Form->postLink(__(''), ['action' => 'deleteCA', $comm['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'fa fa-trash-o']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
                </tfoot>
              </table>
        </div>
<!-- div -->

</section>

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

