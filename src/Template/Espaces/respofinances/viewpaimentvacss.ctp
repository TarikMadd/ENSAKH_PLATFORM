<section class="content-header">
  <h1>
    <?php echo __('Paiment Vacation'); ?>
  </h1>

</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Informations'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">

                    <dt><?= __('Vacataire') ?></dt>
                    <dd>
                        <?= h($vacataire->nom_vacataire.' '.$vacataire->prenom_vacataire) ?>
                    </dd>
                    <dt><?= __('Numéro') ?></dt>
                    <dd>
                        <?= $this->Number->format($paimentvac->Numero) ?>
                    </dd>
                    <dt><?= __('Exercice') ?></dt>
                    <dd>
                        <?= h('Du '.$paimentvac->dateDebut->format('d/m/Y') .' Au '.$paimentvac->dateFin->format('d/m/Y')) ?>
                    </dd>

                    <dt><?= __('Montant Brut') ?></dt>
                    <dd>
                        <?= $this->Number->format($paimentvac->montantBrut, ['places' => 2, 'locale' => 'fr_FR']) ?>
                    </dd>
                    <dt><?= __('Impot') ?></dt>
                    <dd>
                        <?= $this->Number->format($paimentvac->Impot, ['places' => 2, 'locale' => 'fr_FR']) ?>
                    </dd>
                    <dt><?= __('Montant Net') ?></dt>
                    <dd>
                        <?= $this->Number->format($paimentvac->MontantNet, ['places' => 2, 'locale' => 'fr_FR']) ?>
                    </dd>

                    <dt><?= __('Cheque') ?></dt>
                    <dd>
                        <?= h($paimentvac->cheque) ?>
                    </dd>
                    <dt><?= __('Prélèvement') ?></dt>
                    <dd>
                        <?php if($paimentvac->prelevement_id){ ?>
                        <?= $this->Html->link(__('Afficher'), ['action' => 'viewprelevement', $paimentvac->prelevement_id], ['class'=>'btn btn-info btn-xs']) ?>
                        <?php } ?>
                    </dd>

                </dl>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Les fichiers'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dd><?= $this->Html->link(__('Etat des Sommes '), ['action' => 'etatSommesVac', $paimentvac->id], ['class'=>'btn bg-maroon btn-flat margin']) ?> </dd>
                    <dd><?= $this->Html->link(__('Ordre de paiement'), ['action' => 'opVac', $paimentvac->id], ['class'=>'btn bg-purple btn-flat margin']) ?> </dd>
                    <dd><?= $this->Html->link(__('Ordre de paiement Rap'), ['action' => 'opVacRap', $paimentvac->id], ['class'=>'btn bg-orange btn-flat margin']) ?> </dd>

                </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __("Vacations") ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($paimentvac->vacations)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mois
                                    </th>
                                        
                                                                    
                                    <th>
                                    Annee
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nbr Heures
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date Insertion
                                    </th>
                                        
                                                                    
                                    <th>
                                    Etat
                                    </th>
                            </tr>

                            <?php foreach ($paimentvac->vacations as $vacations): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($vacations->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->mois) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->annee) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->nbHeure) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->dateInsertion->format('d/m/Y')) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->etat) ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
