<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <form action="filtrerGradeFct" method="POST">
                           <div class="panel panel-primary">
             <div class="pull-right"><?= $this->Html->link(__('Affecter Grade'), ['action' => 'affecterGradeFct'], ['class'=>'btn btn-success btn-xs']) ?></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th><?= $this->Paginator->sort('#') ?></th>
                            <th><?= $this->Paginator->sort('N° Somme') ?></th>
                            <th><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Grade') ?></th>
                            <th><?= $this->Paginator->sort('Date Prise') ?></th>

                            
                        </tr>
                        <?php
                        $j=1;
                        foreach ($fonctionnairesGrades as $fonctionnairesGrade):
                            if(!isset($suivant[$j+1])||$suivant[$j+1]<>$fonctionnairesGrade->fonctionnaire_id)
                            {?>
                            <tr>
                                <td><?= $this->Number->format($fonctionnairesGrade->id) ?></td>
                                <td><?= h($fonctionnairesGrade->fonctionnaire->somme)?></td>
                                <td><?= h($fonctionnairesGrade->fonctionnaire->nom_fct)?></td>
                                <td><?= h($fonctionnairesGrade->grade)?></td>
                                <td><?= h($fonctionnairesGrade->date_grade)?></td>

                                
                            </tr>
                        <?php  } endforeach; ?>
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
