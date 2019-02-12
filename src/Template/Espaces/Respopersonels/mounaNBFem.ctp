<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'statistiquesVac'], ['escape' => false])?>
</h4>
<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3>Les vacataires du sexe féminin</h3>
                <div class="row">
                </div>
            </div>
            <dt><?= __('Le nombre est :') ?></dt>
                        <dd>
         <h2>   <?php echo $nbFemme ; ?> </h2>
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
                               
                             
                                
                                 <th><?= $this->Paginator->sort('Téléphone') ?></th>
                                <th><?= $this->Paginator->sort('Email') ?></th>

                            </tr>

                            
                            <?php for ($i=0;$i<$nbFemme;$i++){ ?>
                            <?php foreach ($queries as $querie): ?>
                                <tr>
                                    <td> <?php echo $querie['nom_vacataire'];?> </td>
                                    <td><?php echo $querie['prenom_vacataire']; ?></td>
                                    <td><?php echo $querie['somme'];?></td>
                                    <td><?php echo $querie['specialite']; ?></td>
                             
                           
                                    
                                    <td><?php echo $querie['email_prof']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                            
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
