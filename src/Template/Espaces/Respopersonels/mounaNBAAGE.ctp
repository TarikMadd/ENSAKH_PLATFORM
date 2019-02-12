<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'statistiquesFct'], ['escape' => false])?>
</h4>
<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3>Les vacataires ayant l'age supérieur de 40 ans sont :</h3>
                <div class="row">
                </div>
            </div>
<dt><?= __('Le nombre est :') ?></dt>
                        <dd>
                            <?php echo $agesup; ?>
                        </dd>

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
                               
                                
                               
                                <th><?= $this->Paginator->sort('Email_prof') ?></th>

                            </tr>
                            <?php   for($i=0;$i<$agesup;$i++){ 
                             foreach ($query as $query): ?>
                                <tr>
                                    <td> <?php echo $query['nom_vacataire'];?> </td>
                                    <td><?php echo $query['prenom_vacataire']; ?></td>
                                    <td><?php echo $query['somme'];?></td>
                                    <td><?php echo $query['specialite']; ?></td>
                                
                                   
                                    
                                
                                    <td><?php echo $query['email_prof']; ?></td>

                                </tr>
                            <?php endforeach; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
