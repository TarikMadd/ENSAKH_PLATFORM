<?php
/**
  * @var \App\View\AppView $this
  */
?>

    <section class="content-header">
        <h1>
            Listes des Paiements pour Vacations
            <div class="pull-right"><?= $this->Html->link(__('Ajouter un nouvel Paiement'), ['action' => 'addPaimentVac'], ['class'=>'btn btn-success btn-xs']) ?></div>
        </h1>
    </section>



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
                                <th scope="col">Numéro</th>
                                <th scope="col">Vacataire</th>
                                <th scope="col">Exercice</th>
                                <th scope="col">Chéque</th>
                                <th scope="col">Montant Brut </th>
                                <th scope="col">Taux IGR </th>
                                <th scope="col">Montant NET </th>

                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($paimentvacss))
                                foreach ($paimentvacss as $paimentvac): ?>
                                    <tr>
                                        <td><?= $this->Number->format($paimentvac->Numero) ?></td>
                                        <td><?php echo $paimentvac->vacataire->nom_vacataire." ".$paimentvac->vacataire->prenom_vacataire ?></td>
                                        <td><?= h(' Du '.$paimentvac->dateDebut->format('d/m/Y').' Au '.$paimentvac->dateFin->format('d/m/Y')) ?></td>
                                        <td><?= h($paimentvac->cheque) ?></td>
                                        <td><?= $this->Number->format($paimentvac->montantBrut, ['places' => 2]) ?></td>
                                        <td><?= $this->Number->format($paimentvac->Impot, ['places' => 2]) ?></td>
                                        <td><?= $this->Number->format($paimentvac->MontantNet, ['places' => 2]) ?></td>
                                        <td class="actions" style="white-space:nowrap">
                                            <?= $this->Html->link(__('Afficher'), ['action' => 'viewpaimentvacss', $paimentvac->id], ['class'=>'btn btn-info btn-xs']) ?>
                                            <?= $this->Html->link(__('Modifier'), ['action' => 'editpaimentvacs', $paimentvac->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                            <?php
                                                 if(!$paimentvac->prelevement_id)
                                                     echo $this->Form->postLink(__('Sup'), ['action' => 'deletepaimentvacs', $paimentvac->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']);
                                            ?>
                                        </td>
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
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2,3,4,5,6]
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2,3,4,5,6]
                    }
                }, 'colvis' ]
            } );

            table.buttons().container()
                .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        } );
    </script>
<?php $this->end(); ?>