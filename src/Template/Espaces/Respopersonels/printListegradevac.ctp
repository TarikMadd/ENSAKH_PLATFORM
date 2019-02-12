<?php echo $this->Html->image('logo.png'); ?>

<?php $this->layout = 'AdminLTE.printlandscape'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">
 </br>
<p style=" text-align: right;">    KHOURIBGA le <?php  echo date('d\/m\/y'); ?></p>
<br />
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>

     <h5>
             Informations du grade des professeurs vacataires :
</h5>   
  <div class="panel-body">
          <table class="table table-hover">
             <tr>
                <thead> <!-- En-tête du tableau -->
       <tr bgcolor="silver"> 
           <th border="1px solid black">Nom Professeur</th>
           <th border="1px solid black">Prenom Professeur</th>
           <th border="1px solid black">Cadre</th>
           <th border="1px solid black">Grade</th>
           <th border="1px solid black">Echelon</th>
           <th border="1px solid black">Date Prise Grade</th>
           <th border="1px solid black">Date Echelon Prochain</th>
           <th border="1px solid black">Date Avancement Exceptionnel</th>
           <th border="1px solid black">Date Avancement Rapide</th>
           <th border="1px solid black">Date Avancement Normal</th>
       </tr>
   </thead>
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
                              <td class="text"><?= h($professeursGrade->vacataire->nom_vacataire) ?></td>
                              <td  class="text"><?= h($professeursGrade->vacataire->prenom_vacataire) ?></td>
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

</body>
</html>