<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'statistiquesFct'], ['escape' => false])?>
</h4>
<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3>Les fonctionnaires du sexe féminin</h3>
                <div class="row">
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                                <th><?= $this->Paginator->sort('Prenom ') ?></th>
                                <th><?= $this->Paginator->sort('Specialite') ?></th>
                                <th><?= $this->Paginator->sort('Date Recrutement') ?></th>
                                <th><?= $this->Paginator->sort('Date Naissance') ?></th>
                                <th><?= $this->Paginator->sort('Lieu Naissance') ?></th>
                                <th><?= $this->Paginator->sort('Situation Familiale') ?></th>
                                <th><?= $this->Paginator->sort('nombre d\'enfants') ?></th>
                                <th><?= $this->Paginator->sort('Email') ?></th>

                            </tr>
                            <?php foreach ($query as $query): ?>
                                <tr>
                                    <td> <?php echo $query['nom_fct'];?> </td>
                                    <td><?php echo $query['prenom_fct']; ?></td>
                                    <td><?php echo $query['specialite']; ?></td>
                                    <td><?php echo $query['date_Recrut']; ?></td>
                                    <td><?php echo $query['dateNaissance']; ?></td>
                                    <td><?php echo $query['lieuNaissance']; ?></td>
                                    <td><?php echo $query['situation_Familiale']; ?></td>
                                    <td><?php echo $query['nbr_enfants']; ?></td>
                                    <td><?php echo $query['email']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
