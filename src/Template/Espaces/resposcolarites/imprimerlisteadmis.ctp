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
Liste des admis<br>
<?php  echo $_SESSION['etu'][0]['n']." ".$_SESSION['etu'][0]['f']."<br> Année universitaire 2015/2016 <br>";?>
</h3>


<p >  

      <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="220">
                  <col width="220">
                  
                  <col width="30">
                  <thead>
                      
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        <th style="text-align: center">Decision</th>
                        
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
                        
                        <td><?php if($_SESSION['etu'][0]['id'] ==1 || $_SESSION['etu'][0]['id'] ==2) {if($_SESSION['moyenneGeneral'][$j]>=10) echo "ADMIS"; else echo "NON ADMIS";} else {if($_SESSION['moyenneGeneral'][$j]>=12) echo "ADMIS"; else echo "NON ADMIS";}?></td>
                      </tr>
                      <?php $j++; }?>
                      
                    </tbody>
                  </table>

</body>
</html>