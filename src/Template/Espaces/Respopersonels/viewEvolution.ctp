<!-- Content Header (Page header) -->
<section class="content-header">

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
        <div class="panel panel-primary">

            <div class="panel-heading">Chronologie  des grades  :  </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">

              <?php
              foreach ($profpermanentsGrade as $professeurGrade)
                            {
                            $nom = $professeurGrade->profpermanent->nom_prof;
                            $prenom=$professeurGrade->profpermanent->prenom_prof ;
                             break;
                            }
                            $asa=0;
                             foreach ($profpermanentsGrade as $professeurGrade)
                                                        {
                                                        $asa++;
                                                        }
               echo  '<div class="text">'.$nom.'   '.$prenom.'</div><br>';
               $tst=0;
               foreach ($profpermanentsGrade as $professeurGrade)
              {
              $tst++;

               if($tst!=0 && $tst==$asa)
               {
                              echo  '<div class="text">Actuellement :  '.$professeurGrade->grade->nomGrade.' depuis '.$professeurGrade->date_grade.'</div><br>';

               }
               else
               {
                 echo  '<div class="text"> En :  '.$professeurGrade->date_grade.'  était  '.$professeurGrade->grade->nomGrade.'  Classe : '.$professeurGrade->sous_grade.' Echelon '.$professeurGrade->echelon.'</div><br>';
               }

              }
              ?>
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
