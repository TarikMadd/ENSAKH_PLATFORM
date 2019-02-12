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
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'mouvementService'], ['escape' => false])?>
        </li>
    </ol>
</section>
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
                        <tbody>
                        <tright style="margin:50px" class="img-rounded"><?php echo $this->Html->image('15.jpg'); ?></tright>

                        <tr style="text-align: center">
                            <td><strong>NOM : </strong><?= h($fonctionnaire->nom_fct) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>PRENOM : </strong><?= h($fonctionnaire->prenom_fct) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>SERVICE : </strong><?= h($service->nom_service) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>DATE DEBUT : </strong><?= h($fonctionnaireServ->date_debut) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>DATE NAISSANCE : </strong><?= h($fonctionnaire->dateNaissance) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>LIEU NAISSANCE : </strong><?= h($fonctionnaire->lieuNaissance) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>ETAT : </strong><?= h($fonctionnaire->etat) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>SITUATION FAMILIALE : </strong><?= h($fonctionnaire->situation_Familiale) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>NOMBRE D'ENFANTS : </strong><?= h($fonctionnaire->nbr_enfants) ?></td>
                        </tr>
                        <tr style="text-align: center">
                            <td><strong>EMAIL : </strong><?= h($fonctionnaire->email) ?></td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</section>
