<!-- Content Header (Page header) -->
<section class="content-header">


</section>
<?php echo $this->Html->script('searchbis.js');?>
<?php echo $this->Html->script('jquery-3.1.1.min.js');?>
<?php
$i=1;
foreach ($profpermanentsGrades as $professeursGrade)
{
  //debug($professeursGrade);
$suivant[$i]=$professeursGrade->profpermanent_id;
$i++;
}?>



<!-- Main content -->
<section class="content-header">

   <h1> <div class="pull-right">
       <?= $this->Html->link(__('Imprimer la Liste'), ['action' => 'printListegradeperm'], ['class'=>'btn btn-info btn-xs','class'=>'glyphicon glyphicon-duplicate']) ?> </div></h1> 
</section>

<section class="content" >
  <div class="row" >
    <div class="col-xs-12" >
      <div class="box" >
        <div class="box-header" >
          <h3 class="box-title" > </h3>
          <div class="box-tools" >
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
         <div class="panel panel-primary">
             <div class="pull-right"><?= $this->Html->link(__('Affecter Grade'), ['action' => 'affecterGradeProf'], ['class'=>'btn btn-success btn-xs']) ?></div>

                    <div class="panel-heading"><h4>    - Liste des grades actuels pour les professeurs permanents :
</h4>
                    </div>
                    <div class="panel-body">
          <table class="table table-hover">
            <tr>
              <th <?= $this->Paginator->sort('Nom Professeur') ?></th>
              <th ><?= $this->Paginator->sort('Prénom Professeur') ?></th>
              <th ><?= $this->Paginator->sort('Cadre') ?></th>
               <th  ><?= $this->Paginator->sort('Grade') ?></th>
              <th ><?= $this->Paginator->sort('Echelon') ?></th>
              <th ><?= $this->Paginator->sort('Date Prise Grade') ?></th>
              <th ><?= $this->Paginator->sort('Date Echelon Prochain') ?></th>
              <th ><?= $this->Paginator->sort('Date Avancement Exceptionnel') ?></th>
              <th ><?= $this->Paginator->sort('Date Avancement Rapide') ?></th>
              <th ><?= $this->Paginator->sort('Date Avancement Normal') ?></th>
            </tr>
            <?php
            $j=1;
            Cake\I18n\Date::setToStringFormat('yyyy-MM-dd');
            Cake\I18n\FrozenDate::setToStringFormat('yyyy-MM-dd');


            foreach ($profpermanentsGrades as $professeursGrade)
            {
              unset($exceptionnel, $normal1, $normal2, $rapide);
              if($professeursGrade->date_grade){
              //debug($professeursGrade->date_grade);
              $cadre = $professeursGrade->cadre;
              $echProchain = $professeursGrade->date_grade->addYear(2);
              if(!isset($suivant[$j+1])||$suivant[$j+1]<>$professeursGrade->profpermanent_id)
              {
                if($professeursGrade->echelon == 3 ) 
                  $exceptionnel =  $professeursGrade->date_grade->addYear(2);
                elseif ($professeursGrade->echelon == 4 && $professeursGrade->date_grade->wasWithinLast('1 year')) 
                  $rapide = $professeursGrade->date_grade->addYear(1);
                elseif ($professeursGrade->echelon == 4 && ($professeursGrade->date_grade->wasWithinLast('2 years') OR $professeursGrade->date_grade->wasWithinLast('3 years')) ) {
                  # code...
                  $normal1 = $professeursGrade->date_grade->addYear(2);
                  $normal2 = $professeursGrade->date_grade->addYear(3);
                }
              } 
            
                

                ?>
               <tr>
                              <td class="text"><?= h($professeursGrade->profpermanent->nom_prof) ?></td>
                              <td  class="text"><?= h($professeursGrade->profpermanent->prenom_prof) ?></td>
                              <td  class="text"><?= $cadre == 'H' ? 'Habilité ' : ($cadre == 'PES'? 'Prof Enseignement Sup' : 'Assistant') ?></td>
                               <td  class="text"><?= h($professeursGrade->sous_grade) ?></td>
                              <td  class="text"><?= h($professeursGrade->echelon) ?></td>
                              <td  class="text"><?= $professeursGrade->date_grade ?></td>
                              <td  class="text"><?= h($echProchain) ?></td>
                              <td  class="text"><?= h(isset($exceptionnel)? 'Eligible le : '.$exceptionnel : 'Pas Eligible') ?></td>
                              <td  class="text"><?= h(isset($rapide)? 'Eligible le : '.$rapide : 'Pas Eligible') ?></td>
                              <td  class="text"><?= h(isset($normal1)? 'Eligible le : '.$normal1.' OU '.$normal2 : 'Pas Eligible') ?></td>
                              <td class="actions" style="white-space:nowrap">

                              </td>
                            </tr>
                            <?php
                            $j++;
                            }
                            else{
                            $j++;
                          ?>
                          <tr>
                              <td class="text"><?= h($professeursGrade->profpermanent->nom_prof) ?></td>
                              <td  class="text"><?= h($professeursGrade->profpermanent->prenom_prof) ?></td>
                              <td  class="text"><?= $cadre == 'H' ? 'Habilité ' : ($cadre == 'PES'? 'Prof Enseignement Sup' : 'Assistant') ?></td>
                               <td  class="text"><?= h($professeursGrade->sous_grade) ?></td>
                              <td  class="text"><?= h($professeursGrade->echelon) ?></td>
                              <td  class="text"><?= 'Date grade non-valide' ?></td>
                              <td  class="text"><?= h($echProchain) ?></td>
                              <td  class="text"><?= 'Date grade non-valide' ?></td>
                              <td  class="text"><?= 'Date grade non-valide' ?></td>
                              <td  class="text"><?= 'Date grade non-valide' ?></td>
                              <td class="actions" style="white-space:nowrap">

                              </td>
                            </tr>
                            <?php

                            
                          
                          }
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
