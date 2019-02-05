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
<?php if($_SESSION['sess']==1) echo "Liste des résultats provisoires"; else echo "Liste des résultats finaux" ?><br>
<?php  echo $_SESSION['classe']."<br> Année universitaire 2015/2016 <br>".$_SESSION['lib_sem']."<br>";?>
</h3>
<h5 style=" text-align: center;"><?php echo $_SESSION['nom_mod'];?></h5>   

<p >  

      <table class="table table-bordered table-striped">
                 <col width="30">
                  <col width="100">
                  <col width="130">
                  <col width="130">
                  <?php
                   for ($i=1; $i <= $_SESSION['nbr_ele'][0]['n']; $i++) 
                          { ?>
                             <col width="100">
                          <?php } 
                  ?>
                  <?php 
                    if($_SESSION['nbr_ele'][0]['n']>1)
                    {
                      echo "<col width=\"100\">";
                    }
                  ?>
                  <thead>
                      <tr>
                        
                        
                      </tr>
                      <tr>
                        <th>N°</th>
                        <th>CNE</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <?php
                          for ($i=0; $i < $_SESSION['nbr_ele'][0]['n']; $i++)
                          { ?>
                             <th><?php echo $_SESSION['ele'][$i]['libile'];?></th>
                          <?php } 
                        ?>
                        <?php 
                          if($_SESSION['nbr_ele'][0]['n']>1)
                          {
                            echo "<th rowspan=\"2\">RESULTAT</th>";
                          }
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
                        <?php $somme=0;for ($i=0; $i < $_SESSION['nbr_ele'][0]['n']; $i++) 
                        { ?>
                            <td>
                            <?php 
                            if($_SESSION['sess']==1)
                              {
                                $somme += $_SESSION['notes'][$i][$j];
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
                                 $somme += $_SESSION['notes'][$i][$j];
                                  if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                {
                                  if($_SESSION['notes'][$i][$j]>=10)
                                    echo "Validé";
                              
                                else if($_SESSION['notes'][$i][$j]<10 && $_SESSION['notes'][$i][$j]>=7 )
                                  echo "Non validé";
                                else
                                  echo "Ajourné";
                                }
                                else
                                {
                                  if($_SESSION['notes'][$i][$j]>=12)
                                    echo "Validé";
                              
                                else if($_SESSION['notes'][$i][$j]<12 && $_SESSION['notes'][$i][$j]>=8 )
                                  echo "Non validé";
                                else
                                  echo "Ajourné";
                                }
                               } ?>
                            </td>
                       <?php }?>
                       <?php
                       if($_SESSION['nbr_ele'][0]['n']>1)
                       { echo '<td>';
                        if($_SESSION['sess']==1)
                              {
                                if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                {
                                  if($somme/$_SESSION['nbr_ele'][0]['n']>=10)
                                    echo "Validé";
                              
                                else
                                  echo "Rattrapage";
                                }
                                else
                                {
                                  if($somme/$_SESSION['nbr_ele'][0]['n']>=12)
                                    echo "Validé";
                              
                                else
                                  echo "Rattrapage";
                                }
                              }
                              else
                               {
                                  if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                {
                                  if($somme/$_SESSION['nbr_ele'][0]['n']>=10)
                                    echo "Validé";
                              
                                else if($somme/$_SESSION['nbr_ele'][0]['n']<10 && $somme/$_SESSION['nbr_ele'][0]['n']>=7 )
                                  echo "Non validé";
                                else
                                  echo "Ajourné";
                                }
                                else
                                {
                                  if($somme/$_SESSION['nbr_ele'][0]['n']>=12)
                                    echo "Validé";
                              
                                else if($somme/$_SESSION['nbr_ele'][0]['n']<12 && $somme/$_SESSION['nbr_ele'][0]['n']>=8 )
                                  echo "Non validé";
                                else
                                  echo "Ajourné";
                                }
                               }
                               echo '</td>';
                       }

                       
                        ?>
                      </tr>
                      <?php $j++; }?>
                      
                    </tbody>
                    
                  </table>

</body>
</html>