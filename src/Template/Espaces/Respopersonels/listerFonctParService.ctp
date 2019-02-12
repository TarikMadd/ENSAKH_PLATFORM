<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Fonctionnaires Services
        <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'ajouterFonctParService'], ['class'=>'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __('List of') ?> Fonctionnaires Services</h3>
                    <div class="box-tools">

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('Num Somme') ?></th>
                            <th><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Nom Service') ?></th>
                            <th><?= $this->Paginator->sort('Date Debut') ?></th>

                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($FonctionnairesServices as $fonctionnairesService): ?>
                            <tr>
                                <td><?= $this->Number->format($fonctionnairesService->id) ?></td>
                                    <td><?= h($fonctionnairesService->fonctionnaire->somme)?></td>
                                <td><?= h($fonctionnairesService->fonctionnaire->nom_fct)?></td>
                                <td><?= h($fonctionnairesService->service->nom_service)?></td>
                                <td><?= h($fonctionnairesService->date_debut)?></td>

                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Consulter'), ['action' => 'viewService', $fonctionnairesService->fonctionnaire->id,$fonctionnairesService->service->id,$fonctionnairesService->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editService', $fonctionnairesService->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteFonctService', $fonctionnairesService->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
