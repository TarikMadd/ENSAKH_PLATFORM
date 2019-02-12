<?php
/**
 * @var \App\View\AppView $this
 */
?>
    <form method="post" action="">
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Ajouter un Prélèvement  </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

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
                </div>
            <!-- /.box-header -->
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des paiements</h3>
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

                                <th scope="col" class="actions"><?= __('choix') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($paimentsupss as $paimentsup): ?>
                                <tr>
                                    <td><?= $this->Number->format($paimentsup->Numero) ?></td>
                                    <td><?php echo $paimentsup->professeur->nom_prof." ".$paimentsup->professeur->prenom_prof ?></td>
                                    <td><?= h(' Du '.$paimentsup->dateDebut->format('d/m/Y').' Au '.$paimentsup->dateFin->format('d/m/Y')) ?></td>
                                    <td><?= h($paimentsup->cheque) ?></td>
                                    <td><?= $this->Number->format($paimentsup->montantBrut, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td><?= $this->Number->format($paimentsup->Impot, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td><?= $this->Number->format($paimentsup->MontantNet, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="paimentsups[]" class="flat-red" value="<?= h($paimentsup->id) ?>">
                                        </label>
                                    </td>
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