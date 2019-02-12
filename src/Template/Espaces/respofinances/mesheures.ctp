<?php
/**
 * @var \App\View\AppView $this
 */
?>

    <section class="content-header">
        <h1>
            Les Heures supplémentaires
            <div class="pull-right"><?= $this->Html->link(__('Ajouter une nouvelle entrée heures sup'), ['action' => 'addSup'], ['class'=>'btn btn-success btn-xs']) ?></div>
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
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col">Professeur</th>
                                <th scope="col">annee</th>
                                <th scope="col">mois</th>
                                <th scope="col">nbr Heures</th>
                                <th scope="col">etat</th>

                                <th scope="col" class="actions"><?= __('Actions') ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($supheures as $sup): ?>
                                <tr>
                                    <td><?= $this->Number->format($sup->id) ?></td>
                                    <td><?= h($sup->profpermanent->nom_prof." ".$sup->profpermanent->prenom_prof) ?></td>
                                    <td><?= h($sup->annee) ?></td>
                                    <td><?= $this->Number->format($sup->mois) ?></td>

                                    <td><?= $this->Number->format($sup->nbHeure) ?></td>
                                    <?php
                                    if($sup->etat=="non validé") {
                                        echo "<td><span class=\"label label-danger\">$sup->etat</span></td>";
                                    }else if($sup->etat=="validé")
                                        echo "<td><span class=\"label label-primary\">$sup->etat</span></td>";
                                    else
                                        echo "<td><span class=\"label label-success\">$sup->etat</span></td>";
                                    if($sup->etat!="payé"){
                                    ?>

                                        <td class="actions" style="white-space:nowrap">
                                            <?= $this->Html->link(__('modifier'), ['action' => 'editSup', $sup->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                            <?= $this->Form->postLink(__('supprimer'), ['action' => 'deleteSup', $sup->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer définitivement cette vacation ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                        </td>

                                        </tr> <?php }else{
                                        echo "<td></td>";
                                    }?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

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
        buttons: [ 'copy',  {
                        extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
                    }, 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
    </script>
<?php $this->end(); ?>