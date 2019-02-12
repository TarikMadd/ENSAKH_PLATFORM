<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        La liste des activités des fonctionnaires
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>

                            <th><?= $this->Paginator->sort('Nom fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Prenom fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Nom Activite') ?></th>
                            <th><?= $this->Paginator->sort('ID Fct') ?></th>
                            <th><?= $this->Paginator->sort('ID Activite') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($FonctionnairesActivites as $fonctionnairesActivite): ?>
                            <tr>

                                <td><?= h($fonctionnairesActivite->fonctionnaire->nom_fct)?></td>
                                <td><?= h($fonctionnairesActivite->fonctionnaire->prenom_fct)?></td>
                                <td><?= h($fonctionnairesActivite->activite->nomActivite)?></td>
                                <td><?= $fonctionnairesActivite->has('fonctionnaire') ? $this->Html->link($fonctionnairesActivite->fonctionnaire->id, ['controller' => 'Fonctionnaires','action' => 'viewActivite', $fonctionnairesActivite->fonctionnaire->id]) : '' ?></td>
                                <td><?= $fonctionnairesActivite->has('activite') ? $this->Html->link($fonctionnairesActivite->activite->id, ['controller' => 'Activites', 'action' => 'view', $fonctionnairesActivite->activite->id]) : '' ?></td>

                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Consulter'), ['action' => 'viewActivite', $fonctionnairesActivite->fonctionnaire->id,$fonctionnairesActivite->activite->id,$fonctionnairesActivite->id], ['class'=>'label label-primary']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editFonctActivite', $fonctionnairesActivite->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteFonctActivite', $fonctionnairesActivite->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
