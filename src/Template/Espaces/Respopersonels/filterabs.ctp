

<?php
/**
 * @var \App\View\AppView $this
 */
?>

                <div class="absences index large-9 medium-8 columns content">
                    <h3>L'absence choisie est:</h3>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('Id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Id Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Durée Absence') ?></th>
                            <th><?= $this->Paginator->sort('Cause Absence') ?></th>
                            <th><?= $this->Paginator->sort('Date Absence') ?></th>
							<th><?= $this->Paginator->sort('Heure Absence') ?></th>


                           
                        </tr>
                        <?php foreach ($absences as $absences): ?>
                            <tr>
                                <td>  <?php echo $absences['id']; ?> </td>
                                <td> <?php echo $absences['fonctionnaire_id'];?> </td>
                                <td><?php echo $absences['duree_ab']; ?></td>
                                <td><?php echo $absences['cause'];?></td>
                                <td><?php echo $absences['date_ab'];?></td>
                                <td><?php echo $absences['time_ab'];?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </table>
                        <div>
                            <br>
                            <button type="button" class="btn btn-info"><a href="abs">Retour</a></button>
                        </div>
                   </div>
                </div>