<?php
/**
  * @var \App\View\AppView $this
  */
?>
    <form method="post" action="AddPaimentVac3">
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Ajouter un paiment  </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date de debut</label>
                            <div  id="sandbox-container">
                                <div class="input-group date">
                                    <input type="text" name="dateDebut" class="form-control" value="<?php echo date("01/01/Y"); ?>" required>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                         <div  id="sandbox-container">
                             <label for="exampleInputEmail1">Date de fin</label>
                            <div class="input-group date">
                                <input type="text" name="dateFin" class="form-control"  value="<?php echo date("31/12/Y"); ?>" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                         </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">N° de Paiment</label>
                            <input type="number" name="Numero" class="form-control" id="nbHeure"  min="1" >
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">N° de chèque </label>
                            <input type="text" name="cheque" class="form-control" id="cheque">
                        </div>
                    </div>

                </div>
            </div>
            </div>


        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des vacations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>

                                <th scope="col">Annee</th>
                                <th scope="col">Mois</th>
                                <th scope="col">Nbr Heures</th>
                                <th scope="col">Etat</th>

                                <th scope="col">Choix</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $months = array (1=>'Janvier',2=>'février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'juillet',8=>'aout',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');
                            foreach ($vacations as $vacation): ?>
                                <tr>
                                    <td><?= $this->Number->format($vacation->id) ?></td>
                                    <td><?= h($vacation->annee) ?></td>
                                    <td><?= $months[$vacation->mois] ?></td>

                                    <td><?= $this->Number->format($vacation->nbHeure) ?></td>
                                    <?php
                                    if($vacation->etat=="non validé") {
                                        echo "<td><span class=\"label label-danger\">$vacation->etat</span></td>";
                                    }else if($vacation->etat=="valide")
                                        echo "<td><span class=\"label label-primary\">$vacation->etat</span></td>";
                                    else
                                        echo "<td><span class=\"label label-success\">$vacation->etat</span></td>";
                                    ?>

                                    <td><label>
                                            <input type="checkbox" name="vacations[]" class="flat-red" value="<?= h($vacation->id) ?>">
                                        </label></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="box-footer" style="text-align: center">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="reset" class="btn btn-default">Réinitialiser</button>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
        <?= $this->Form->end() ?>

<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
    'AdminLTE./plugins/datepicker/datepicker3',
],
    ['block' => 'css']);

$this->Html->script([
    'AdminLTE./plugins/datatables/jquery.dataTables.min',
    'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
    'AdminLTE./plugins/datepicker/bootstrap-datepicker.js',

],
    ['block' => 'script']);

?>

<?php $this->start('scriptBotton'); ?>
    <script>
        $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: true,

    } );

} );
        $('#sandbox-container .input-group.date').datepicker({
            format: "dd/mm/yyyy",
            startView: 1,
            todayBtn: "linked",
            language: "fr",
            autoclose: true
        });

    </script>
<?php $this->end(); ?>