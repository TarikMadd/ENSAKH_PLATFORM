<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
La liste des fonctionnaires par service
        <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'ajouterMvtService'], ['class'=>'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('') ?></h3>
                    <div class="box-tools">
                        <form action="fetch1Service" method="POST">
                            <div class="input-group input-group-sm"  style="width: 180px;">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                             </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>

                            <th><?= $this->Paginator->sort('N° Somme') ?></th>
                            <th><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Prénom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Nom Service') ?></th>
                            <th><?= $this->Paginator->sort('date Debut') ?></th>
                            <th><?= $this->Paginator->sort('Id Fct') ?></th>
                            <th><?= $this->Paginator->sort('Id Service') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($FonctionnairesServices as $FonctionnairesService): ?>
                            <tr>

                                <td><?= h($FonctionnairesService->fonctionnaire->somme)?></td>
                                <td><?= h($FonctionnairesService->fonctionnaire->nom_fct)?></td>
                                <td><?= h($FonctionnairesService->fonctionnaire->prenom_fct)?></td>
                                <td><?= h($FonctionnairesService->service->nom_service)?></td>
                                <td><?= $FonctionnairesService->has('service') ? $this->Html->link($FonctionnairesService->date_debut, ['controller' => 'Services', 'action' => 'view', $FonctionnairesService->date_Debut]) : '' ?></td>
                                <td><?= $FonctionnairesService->has('fonctionnaire') ? $this->Html->link($FonctionnairesService->fonctionnaire->id, ['controller' => 'Respopersonels', 'action' => 'view', $FonctionnairesService->fonctionnaire->id]) : '' ?></td>
                                <td><?= $FonctionnairesService->has('service') ? $this->Html->link($FonctionnairesService->service->id, ['controller' => 'Services', 'action' => 'view', $FonctionnairesService->service->id]) : '' ?></td>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Consulter'), ['action' => 'viewMouvement', $FonctionnairesService->fonctionnaire->id,$FonctionnairesService->service->id,$FonctionnairesService->id], ['class'=>'label label-primary']) ?>
                                   
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteMouvement', $FonctionnairesService->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
<!-- /.content -->
