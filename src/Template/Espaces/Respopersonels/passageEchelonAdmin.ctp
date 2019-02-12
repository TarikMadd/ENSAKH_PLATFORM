<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 class="Activite">
    - Liste des professeurs permanents qui vont passer à l'échelon suivant :
    <div class="pull-right"><?= $this->Html->link(__('Affecter Grade'), ['action' => 'affecterGradeProf'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>
<?php echo $this->Html->script('searchbis.js');?>
<?php echo $this->Html->script('jquery-3.1.1.min.js');?>
<?php
$i=1;
foreach ($profpermanentsGrades as $professeursGrade)
{
$suivant[$i]=$professeursGrade->profpermanent_id;
$i++;
}?>



<!-- Main content -->
<section class="content" >
  <div class="row" >
    <div class="col-xs-12" >
      <div class="box" >
        <div class="box-header" >
          <h3 class="box-title" > </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th class="text"bgcolor="black"><?= $this->Paginator->sort('Nom fonctionnaires') ?></th>
              <th  class="text"bgcolor="black"><?= $this->Paginator->sort('Prénom fonctionnaires') ?></th>
              <th class="text"bgcolor="black"><?= $this->Paginator->sort('Grade') ?></th>
               <th  class="text" bgcolor="black"><?= $this->Paginator->sort('echelle') ?></th>
              <th class="text" bgcolor="black"><?= $this->Paginator->sort('Echelon') ?></th>

              <th class="text" bgcolor="black"><?= $this->Paginator->sort('date_grade') ?></th>
              <th class="text"bgcolor="black"><?= __('Actions') ?></th>
            </tr>
            <?php
            $j=1;
            foreach ($queries as $query)
            {
              if(!isset($suivant[$j+1])||$suivant[$j+1]<>$query->fonctionnaire_id)
              {?>
               <tr>
                              <td bgcolor="grey" class="text"><?= h($query->fonctionnaire->nom_fct) ?></td>
                              <td bgcolor="grey class="text"><?= h($query->fonctionnaire->prenom_fct) ?></td>
                              <td bgcolor="orange" class="text"><?= h($query->fonctionnaire->echelle) ?></td>
                               <td bgcolor="yellow" class="text"><?= h($query->fonctionnaire->echelon) ?></td>
                              <td bgcolor="yellow" class="text"><?= h($query->fonctionnaires_grades->date_echelon) ?></td>

                            
                              <td class="actions" style="white-space:nowrap">
                          
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
