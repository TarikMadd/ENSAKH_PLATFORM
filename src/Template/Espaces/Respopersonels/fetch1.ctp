<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'fetch'], ['escape' => false])?>
</h4>
<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Résultat de la recherche des fonctionnaires</h3>
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
                <th><?= $this->Paginator->sort('N° Somme') ?></th>
                <th><?= $this->Paginator->sort('Specialite') ?></th>
                <th><?= $this->Paginator->sort('Echelle') ?></th>
                <th><?= $this->Paginator->sort('Date Recrutement') ?></th>
                <th><?= $this->Paginator->sort('Date Naissance') ?></th>
                <th><?= $this->Paginator->sort('Lieu Naissance') ?></th>


                <th><?= $this->Paginator->sort('Code Diplome') ?></th>
                <th><?= $this->Paginator->sort('UE Diplome') ?></th>
                <th><?= $this->Paginator->sort('Email') ?></th>

            </tr>
            <?php foreach ($query as $query): ?>
                <tr>
                    <td> <?php echo $query['nom_fct'];?> </td>
                    <td><?php echo $query['prenom_fct']; ?></td>
                    <td><?php echo $query['somme'];?></td>
                    <td><?php echo $query['specialite']; ?></td>
                    <td><?php echo $query['echelle']; ?></td>
                    <td><?php echo $query['date_Recrut']; ?></td>
                    <td><?php echo $query['dateNaissance']; ?></td>
                    <td><?php echo $query['lieuNaissance']; ?></td>



                    <td><?php echo $query['cdDiplome']; ?></td>
                    <td><?php echo $query['ueDiplome']; ?></td>
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
