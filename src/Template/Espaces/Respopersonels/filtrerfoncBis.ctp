<?php
/**
 * @var \App\View\AppView $this
 */
?>

                <div class="professeurs index large-9 medium-8 columns content">
                    <h3>Professeur Recherché:</h3>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Nom Prof') ?></th>
                            <th><?= $this->Paginator->sort('prenom_prof') ?></th>
                            <th><?= $this->Paginator->sort('somme') ?></th>
                            <th><?= $this->Paginator->sort('specialite') ?></th>
                            <th><?= $this->Paginator->sort('echelle') ?></th>
                            <th><?= $this->Paginator->sort('echelon') ?></th>
                            <th><?= $this->Paginator->sort('Date Recrutement') ?></th>
                            <th><?= $this->Paginator->sort('Date Naissance') ?></th>
                            <th><?= $this->Paginator->sort('Age') ?></th>


                        </tr>
                        <?php foreach ($Profpermanents as $prof): ?>
                            <tr>
                                <td>  <?php echo $prof['id']; ?> </td>
                                <td> <?php echo $prof['nom_prof'];?> </td>
                                <td><?php echo $prof['prenom_prof']; ?></td>
                                <td><?php echo $prof['somme'];?></td>
                                <td><?php echo $prof['specialite']; ?></td>
                                <td><?php echo $prof['echelle']; ?></td>
                                <td><?php echo $prof['echelon']; ?></td>
                                <td><?php echo $prof['date_Recrut']; ?></td>
                                <td><?php echo $prof['dateNaissance']; ?></td>
                                <td><?php echo $prof['age']; ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </table>
                           <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'foncBis'], ['escape' => false]) ?>

                   </div>
                </div>






