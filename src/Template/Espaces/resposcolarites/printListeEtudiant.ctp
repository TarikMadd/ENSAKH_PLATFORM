<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">

<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP']); ?>
</div> </br>
<p style=" text-align: right;">    KHOURIBGA le <?php  echo date('d\/m\/y'); ?></p>
<br />
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>
<br />
<br />
     <h5>
             Informations Etudiant :
</h5>   

<p >  
<?php

$day  = date('d');
$day=$day+5;
$year = date('y');
$month  = date('m ');;
if($day>29)
{
	$day=$day-29;
$month=$month+1;
	if($month>12)
	{
		$year=$year+1;
	}

}
?>
      <table class="table table-hover" text>
   <thead> <!-- En-tête du tableau -->
       <tr bgcolor="silver">
           <th border="1px solid black">Nom Français</th>
           <th border="1px solid black">Nom Arabe</th>
           <th border="1px solid black">Prenom Français</th>
           <th border="1px solid black">Prenom Arabe</th>
           <th border="1px solid black">CNE</th>
           <th border="1px solid black">Code Apogé</th>
       </tr>
   </thead>

   <tbody> <!-- Corps du tableau -->
            <?php foreach ($etudiants as $etudiant): ?>
              <tr>
                <td><?= h($etudiant->nom_fr) ?></td>
                <td><?= h($etudiant->nom_ar) ?></td>
                <td><?= h($etudiant->prenom_fr) ?></td>
                <td><?= h($etudiant->prenom_ar) ?></td>
                <td><?= h($etudiant->cne) ?></td>
                <td><?= h($etudiant->apogee) ?></td>

       </tr>
        <?php endforeach; ?>
   </tbody>
</table>

</body>
</html>