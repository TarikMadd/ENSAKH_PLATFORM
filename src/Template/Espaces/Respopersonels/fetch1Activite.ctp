<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'afficherFonctEvent'], ['escape' => false])?>

<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3>Résultat de la recherche</h3>
                <div class="row">
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-user-information">
                            <tbody>
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">

            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th><?= $this->Paginator->sort('Nom d\'Evénement') ?></th>
                <th><?= $this->Paginator->sort('date début d\'Evénement') ?></th>
                <th><?= $this->Paginator->sort('date Fin d\'Evénement') ?></th>

            </tr>
            <?php foreach ($query as $query): ?>
                <tr>
                    <td>  <?php echo $query['id']; ?> </td>
                    <td> <?php echo $query['nomActivite'];?> </td>
                    <td><?php echo $query['dateDebut']; ?></td>
                    <td><?php echo $query['dateFin'];?></td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

