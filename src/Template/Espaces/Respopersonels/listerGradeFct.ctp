<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Fonctionnaires Grades
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <form action="filtrerGradeFct" method="POST">
                            <div class="input-group input-group-sm"  style="width: 180px;">
                                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                            </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><?= $this->Paginator->sort('#') ?></th>
                            <th><?= $this->Paginator->sort('N°Somme') ?></th>

                            <th><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Prénom Fonctionnaire') ?></th>

                            <th><?= $this->Paginator->sort('Grade') ?></th>
                            <th><?= $this->Paginator->sort('Echelle') ?></th>
                            <th><?= $this->Paginator->sort('Date Prise') ?></th>

                            <th><?= __('Actions') ?></th>
                        </tr>
                     <?php foreach ($profpermanentsGrades as $fonctionnairesGrade): ?> 
                            <tr>
                                <td><?= $this->Number->format($fonctionnairesGrade->id) ?></td>
                                <td><?= h($fonctionnairesGrade->fonctionnaire->somme)?></td>
                                <td><?= h($fonctionnairesGrade->fonctionnaire->nom_fct)?></td>
                                <td><?= h($fonctionnairesGrade->fonctionnaire->prenom_fct)?></td>

                                <td> <?= h($fonctionnairesGrade->grade)?></td>

                                <td><?= h($fonctionnairesGrade->date_grade)?></td>
                                                                

                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__('Consulter'), ['action' => 'viewGradeFct', $fonctionnairesGrade->fonctionnaire->id,$fonctionnairesGrade->grade->id,$fonctionnairesGrade->id], ['class'=>'label label-primary']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editGradeFct', $fonctionnairesGrade->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteFonctGrade', $fonctionnairesGrade->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
