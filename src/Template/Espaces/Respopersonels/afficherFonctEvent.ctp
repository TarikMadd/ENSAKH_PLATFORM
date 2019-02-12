

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h3> Les événements réalisés au sein de l'ENSA KHOURIBGA par les fonctionnaires:</h3>
                <div class="box-header">
                    <div class="box-tools">
                        <form action="fetch1Activite" method="POST">
                            <div class="input-group input-group-sm"  style="width: 180px;">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Rechercher') ?>">
                                <span class="input-group-btn">
                           <button class="btn btn-success btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><?= $this->Paginator->sort('#') ?></th>
                            <th><?= $this->Paginator->sort('Nom d\'Evénement') ?></th>

                            <th><?= $this->Paginator->sort('Date début d\'Evénement') ?></th>
                            <th><?= $this->Paginator->sort('Date Fin d\'Evénement') ?></th>

                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php $precedent=0;?>
                        <?php foreach ($fonctionnairesActivites as $fonctionnairesActivite): ?>
                            <?php if($fonctionnairesActivite->activite->id<>$precedent)
                            {?>
                                <tr>
                                <td><?= h($fonctionnairesActivite->id)?></td>
                                <td><?= h($fonctionnairesActivite->activite->nomActivite)?></td>
                                <td><?= h($fonctionnairesActivite->activite->dateDebut)?></td>
                                <td><?= h($fonctionnairesActivite->activite->dateFin)?></td>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Form->postLink(__('Consulter'), ['controller' => 'Respopersonels', 'action' => 'afficherMembre', $fonctionnairesActivite->activite->id] , ['class'=>'btn btn-success btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteFonctActivite2', $fonctionnairesActivite->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>

                                </td>
                                <?php $precedent=$fonctionnairesActivite->activite->id;?>

                                </tr><?php }

                        endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php echo $this->Paginator->numbers(); ?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<section class="content-footer">

        <div class="pull-left"><?= $this->Html->link(__('Nouvel Evénement'), ['action' => 'addActivite'], ['class'=>'btn btn-info btn-s']) ?></div>

        <div class="pull-right"><?= $this->Html->link(__('Nouveau membre '), ['action' => 'affecterFonctEvent'], ['class'=>'btn btn-warning btn-s']) ?></div>

</section>
