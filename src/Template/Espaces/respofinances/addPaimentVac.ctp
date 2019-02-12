<?php
/**
  * @var \App\View\AppView $this
  */
?>


    <div class="vacations form large-9 medium-8 columns content">
        <form method="post" action="AddPaimentVac2">

    

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">choisissez le vacataire concerné</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">Nom et prénom</th>
                                <th scope="col">Diplome</th>
                                <th scope="col">Matiére</th>
                                <th scope="col">établissement</th>
                                <th scope="col">S.O.M</th>
                                <th scope="col">Choix</th>


                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($vacataires as $vacataire): ?>
                            <tr>
                                <td><?= h($vacataire->nom_vacataire) ?>  <?= h($vacataire->prenom_vacataire) ?></td>
                                <td><?= h($vacataire->diplome) ?></td>
                                <td><?= h($vacataire->specialite) ?></td>
                                <td><?= h($vacataire->universite) ?></td>
                                <td><?= h($vacataire->somme) ?></td>
                                <td><label>
                                        <input type="radio" name="vacataire_id" class="flat-red" value="<?= h($vacataire->id) ?>">
                                    </label></td>

                            </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="box-footer" style="text-align: center">
                        <button type="submit" class="btn btn-primary">Continuer</button>
                        <button type="reset" class="btn btn-default">Réinitialiser</button>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<?= $this->Form->end() ?> </div>

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
        $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: true,

    } );


} );
    </script>
<?php $this->end(); ?>