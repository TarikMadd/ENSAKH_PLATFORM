<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 20px;
    margin-left: 20px;">

<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP']); ?>
</div>
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>
<br />
<h3 style=" text-align: center;">
Relevé des notes<br>
<?php  echo $_SESSION['classe']."<br> Année universitaire 2015/2016 <br> PV de délibérations ".$_SESSION['lib_sem']."<br>";?>
</h3>
<table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="110">
                  <col width="110">
                  <?php
                   for ($i=1; $i <= $_SESSION['nbr_mod']; $i++) 
                          { ?>
                             <col width="100">
                          <?php } 
                  ?>
                  
                  <thead>
                      
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        <?php
                          for ($i=0; $i < $_SESSION['nbr_mod']; $i++) 
                          { ?>
                             <th style="text-align: center"><?php echo $_SESSION['modules'][$i]['libile'];?></th>
                          <?php } 
                        ?>
                      </tr>
                    </thead>
                     <tbody>
                      <?php
                      $j=0; 
                      foreach ($_SESSION['etudiants'] as $etudiant) 
                      {?>
                      <tr>
                        <td><?php echo $j+1?></td>
                        <td><?php echo $etudiant['cne']?></td>
                        <td><?php echo $etudiant['nom_fr']?></td>
                        <td><?php echo $etudiant['prenom_fr']?></td> 
                        <?php for ($i=0; $i < $_SESSION['nbr_mod']; $i++) 
                        { ?>
                            <td>
                            <?php 
                            if($_SESSION['sess']==1)
                              {
                                if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                {
                                  if($_SESSION['notes'][$i][$j]>=10)
                                      echo "Validé";
                                                              
                                  else
                                      echo "Rattrapage";
                                }
                                else
                                {
                                  if($_SESSION['notes'][$i][$j]>=12)
                                      echo "Validé";
                                                              
                                  else
                                      echo "Rattrapage";
                                }
                              }
                              else
                                {
                                  if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                {
                                  if($_SESSION['notes'][$i][$j]>=10)
                                      echo "Validé";
                                                              
                                  else
                                      echo "Rattrapage";
                                }
                                else
                                {
                                  if($_SESSION['notes'][$i][$j]>=12)
                                      echo "Validé";
                                                              
                                  else
                                      echo "Rattrapage";
                                }
                                  }?>
                            </td>
                       <?php }?>
                      </tr>
                      <?php $j++; }?>
                      
                    </tbody>
                    </table>
</body>
</html>