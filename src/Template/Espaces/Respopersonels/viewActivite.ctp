<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<section class="content-header">
    <h1>
        <?php echo __(''); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerActivites'], ['escape' => false])?>
        </li>
    </ol>
<br>
<!-- Main content -->
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <h3 class="panel-title"><i class="fa fa-fw fa-info-circle"></i>Informations Supplémentaires</h3>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-striped">
                            <tright style="margin:60px"> <?php echo $this->Html->image('9.jpg'); ?></tright>
                            <tbody>

                            <tr style="text-align: center">
                                <td><strong>NOM :</strong><?= h($fonctionnaire->nom_fct) ?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td><strong>PRENOM :</strong><?= h($fonctionnaire->prenom_fct) ?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td><strong>ACTIVITE :</strong><?= h($activite->nomActivite) ?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td><strong>DATE DEBUT :</strong><?= h($activite->dateDebut) ?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td><strong>DATE FIN :</strong><?= h($activite->dateFin) ?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td><strong>POSTE COMITE :</strong><?= h($fonctActif->poste_comite) ?></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </section>

