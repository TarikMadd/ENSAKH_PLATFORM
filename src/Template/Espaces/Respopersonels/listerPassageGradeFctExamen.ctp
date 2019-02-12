<!-- Content Header (Page header) -->
<section class="content-header">


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
          <div class="box-tools" >
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="gradeCherch" class="form-control" placeholder="<?= __('Chercher') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filtrer') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
         <div class="panel panel-primary">

                    <div class="panel-heading"><h4>    - Avancement de grade pour les Fonctionnaires     :
</h4>
                    </div>
                    <div class="panel-body">
          <table class="table table-hover">
            <tr>
              <th <?= $this->Paginator->sort('NOM FONCTIONNAIRE') ?></th>
              <th ><?= $this->Paginator->sort('PRENOM FONCTIONNAIRE') ?></th>
              <th ><?= $this->Paginator->sort('GRADE ACTUEL') ?></th>
               <th  ><?= $this->Paginator->sort('CATEGORIE') ?></th>
              <th ><?= $this->Paginator->sort('ECHELON') ?></th>
               <th ><?= $this->Paginator->sort('DATE DE PRISE') ?></th>
              <th ><?= $this->Paginator->sort('ACTIONS ') ?></th>



            </tr>
            <?php
            $j=1;
            foreach ($profpermanentsGrades as $professeursGrade)
            {
              if(!isset($suivant[$j+1])||$suivant[$j+1]<>$professeursGrade->profpermanent_id)
              {?>
               <tr>
                              <td class="text"><?= h($professeursGrade->fonctionnaire->nom_fct) ?></td>
                              <td  class="text"><?= h($professeursGrade->fonctionnaire->prenom_fct) ?></td>
                              <td  class="text"><?= h($professeursGrade->grade->nomGrade) ?></td>
                               <td  class="text"><?= h($professeursGrade->categorie) ?></td>
                              <td  class="text"><?= h($professeursGrade->echelon) ?></td>

                              <td  class="text"><?= h($professeursGrade->date_grade) ?></td>
                              <td class="actions" style="white-space:nowrap">
                                <?= $this->Html->link(__('Grade Suivant'), ['action' => 'passerSuivant', $professeursGrade->id,$professeursGrade->grade->nomGrade,10], ['class'=>'btn btn-warning btn-xs']  ) ?>

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
