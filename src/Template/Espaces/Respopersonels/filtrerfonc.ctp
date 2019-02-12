<?php
/**
 * @var \App\View\AppView $this
 */
?>

                <div class="fonctionnaires index large-9 medium-8 columns content">
                    <h3>Le fonctionnaire choisi est:</h3>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('nom_fct') ?></th>
                            <th><?= $this->Paginator->sort('prenom_fct') ?></th>
                            <th><?= $this->Paginator->sort('somme') ?></th>
                            <th><?= $this->Paginator->sort('specialite') ?></th>
                            <th><?= $this->Paginator->sort('Date Recrutement') ?></th>
                            <th><?= $this->Paginator->sort('Date Naissance') ?></th>
                            <th><?= $this->Paginator->sort('Age') ?></th>
                            <th><?= $this->Paginator->sort('Genre') ?></th>
                            <th><?= $this->Paginator->sort('Situation Familiale') ?></th>

                        </tr>
                        <?php foreach ($fonctionnaires as $fonctionnaires): ?>
                            <tr>
                                <td>  <?php echo $fonctionnaires['id']; ?> </td>
                                <td> <?php echo $fonctionnaires['nom_fct'];?> </td>
                                <td><?php echo $fonctionnaires['prenom_fct']; ?></td>
                                <td><?php echo $fonctionnaires['somme'];?></td>
                                <td><?php echo $fonctionnaires['specialite']; ?></td>
                                <td><?php echo $fonctionnaires['date_Recrut']; ?></td>
                                <td><?php echo $fonctionnaires['dateNaissance']; ?></td>
                                <td><?php echo $fonctionnaires['age']; ?></td>
                                <td><?php echo $fonctionnaires['genre']; ?></td>
                                <td><?php echo $fonctionnaires['situation_Familiale']; ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </table>
                        <div>
                            <br>
                            <button type="button" class="btn btn-info"><a href="fonc">Retour</a></button>
                        </div>
                   </div>
                </div>






