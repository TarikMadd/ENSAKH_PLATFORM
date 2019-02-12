<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'mouvementService'], ['escape' => false])?>


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
                <th scope="col"><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
                <th><?= $this->Paginator->sort('Prenom Fonctionnaire') ?></th>
                <th><?= $this->Paginator->sort('Nom Service') ?></th>
                <th><?= $this->Paginator->sort('Date Naissance') ?></th>
                <th><?= $this->Paginator->sort('Lieu Naissance') ?></th>

            </tr>
            <?php foreach ($fonctionnairesServices as $query): ?>
                <tr>
                    <td><?= h($query->fonctionnaire->nom_fct)?></td>
                    <td><?= h($query->fonctionnaire->prenom_fct)?></td>
                    <td><?= h($query->service->nom_service)?></td>
                    <td><?= h($query->fonctionnaire->dateNaissance)?></td>
                    <td><?= h($query->fonctionnaire->lieuNaissance)?></td>

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
    </div>

