<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Professeurs Grades
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'affecterGradeProf'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>
<?php
$i=1;
foreach ($profpermanentsGrades as $professeursGrade)
{
$suivant[$i]=$professeursGrade->profpermanent_id;
$i++;
}?>



<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Professeurs Grades</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('Nom Prof') ?></th>
              <th><?= $this->Paginator->sort('Prénom Prof') ?></th>
              <th><?= $this->Paginator->sort('GradeActuel') ?></th>
              <th><?= $this->Paginator->sort('date_grade') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php
            $j=1;
            foreach ($profpermanentsGrades as $professeursGrade)
            {
              if(!isset($suivant[$j+1])||$suivant[$j+1]<>$professeursGrade->profpermanent_id)
              {?>
               <tr>
                              <td><?= h($professeursGrade->profpermanent->nom_prof) ?></td>
                              <td><?= h($professeursGrade->profpermanent->prenom_prof) ?></td>
                              <td><?= h($professeursGrade->grade->codeGrade) ?></td>
                              <td><?= h($professeursGrade->date_grade) ?></td>
                              <td class="actions" style="white-space:nowrap">
                                <?= $this->Html->link(__('Evolution'), ['action' => 'viewEvolution', $professeursGrade->profpermanent_id], ['class'=>'btn btn-warning btn-xs']  ) ?>

                              </td>
                            </tr>
                            <?php
                            $j++;
                            }
                            else{
                            $j++;}
              }

            ?>
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
