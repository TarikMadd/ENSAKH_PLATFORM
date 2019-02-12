<?php
/**
 * @var \App\View\AppView $this
 */
?>
<section class="content-header">
  <h1>
      Liste  des prélèvements
    <div class="pull-right"><?= $this->Html->link(__('Ajouter un nouvel Prelevement'), ['action' => 'addPrelevementsup'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th>id</th>
                              <th>Exercice</th>
                              <th>total</th>
                              <th><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                            <?php if(isset($prelevementss)) foreach ($prelevementss as $prelevement): ?>
                              <tr>
                                <td><?= $this->Number->format($prelevement->id) ?></td>

                                  <td><?= h(' Du '.$prelevement->dateDebut->format('d/m/Y').' Au '.$prelevement->dateFin->format('d/m/Y')) ?></td>
                                <td><?= h($prelevement->totalImpot) ?></td>
                                <td class="actions" style="white-space:nowrap">
                                  <?= $this->Html->link(__('Aficher'), ['action' => 'viewPrelevementsup', $prelevement->id], ['class'=>'btn btn-info btn-xs']) ?>
                                  <?= $this->Html->link(__('modifier'), ['action' => 'editPrelevementsup', $prelevement->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                  <?= $this->Form->postLink(__('supprimer'), ['action' => 'deletePrelevementsup', $prelevement->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
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
$this->Html->script([

    'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js',
    'https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js',
    'https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js',
    'https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js',
    '//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js',
    '//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js',
    '//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js',
    '//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js',
    '//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js',

],
    ['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [{
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1,2]
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            }, 'colvis' ]
        } );

        table.buttons().container()
            .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    } );
</script>
<?php $this->end(); ?>