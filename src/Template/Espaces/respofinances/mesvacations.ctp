<?php
/**
  * @var \App\View\AppView $this
  */
?>

    <section class="content-header">
        <h1>
            Les vacations
            <div class="pull-right"><?= $this->Html->link(__('Ajouter une nouvelle Vaction'), ['action' => 'addVac'], ['class'=>'btn btn-success btn-xs']) ?></div>
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
                                <th scope="col">id</th>
                                <th scope="col">Vacataire</th>
                                <th scope="col">Année</th>
                                <th scope="col">Mois</th>
                                <th scope="col">Date d'insertion</th>
                                <th scope="col">Nbr Heures</th>
                                <th scope="col">Etat</th>

                                <th scope="col" class="actions"><?= __('Actions') ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $months = array (1=>'Janvier',2=>'février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'juillet',8=>'aout',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');
                            foreach ($vacations as $vacation): ?>
                                <tr>
                                    <td><?= $this->Number->format($vacation->id) ?></td>
                                    <td><?= h($vacation->vacataire->nom_vacataire." ".$vacation->vacataire->prenom_vacataire) ?></td>
                                    <td><?= h($vacation->annee) ?></td>
                                    <td><?= $months[$vacation->mois] ?></td>
                                    <td><?= h($vacation->dateInsertion->format('d/m/Y')) ?></td>

                                    <td><?= $this->Number->format($vacation->nbHeure) ?></td>
                                    <?php
                                    if($vacation->etat=="non validé") {
                                        echo "<td><span class=\"label label-danger\">$vacation->etat</span></td>";
                                    }else if($vacation->etat=="validé")
                                        echo "<td><span class=\"label label-primary\">$vacation->etat</span></td>";
                                    else
                                        echo "<td><span class=\"label label-success\">$vacation->etat</span></td>";
                                    if($vacation->etat!="payé"){
                                    ?>

                                        <td class="actions" style="white-space:nowrap">
                                            <?= $this->Html->link(__('modifier'), ['action' => 'editVac', $vacation->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                            <?= $this->Form->postLink(__('supprimer'), ['action' => 'deletevacation', $vacation->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer définitivement cette vacation ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                        </td>

                                </tr> <?php }else{
                                        echo "<td></td>";
                                    }?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
        buttons: [   {
                        extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2 ,3,4,5,6]
                }
                    }, {
            extend: 'pdf',
            exportOptions: {
                columns: [ 0, 1, 2 ,3,4,5,6]
            }
        }, 'colvis']
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
    </script>
<?php $this->end(); ?>