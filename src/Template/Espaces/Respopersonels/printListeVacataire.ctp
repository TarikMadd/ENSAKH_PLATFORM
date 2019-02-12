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
             Informations Vacataire :
</h5>   

<p >  
<?php

$day  = date('d');
$day=$day+5;
$year = date('y');
$month  = date('m');;
if($day>29)
{
	$day=$day-29;
$month=$month+01;
	if($month>12)
	{
		$year=$year+1;
	}

}
?>
      <table class="table table-hover" text>
   <thead> <!-- En-tête du tableau -->
       <tr bgcolor="silver"> 
           <th border="1px solid black">CIN</th>
           <th border="1px solid black">nom_vacataire</th>
           <th border="1px solid black">prenom_vacataire</th>
           <th border="1px solid black">nb_heures</th>
           <th border="1px solid black">echelle</th>
           <th border="1px solid black">dateRecrut</th>
           <th border="1px solid black">dateAffectation</th>
       </tr>
   </thead>

   <tbody> <!-- Corps du tableau -->
            <?php foreach ($vacataires as $vacataire): ?>
              <tr>
                <td><?= h($vacataire->CIN) ?></td>
                <td><?= h($vacataire->nom_vacataire) ?></td>
                <td><?= h($vacataire->prenom_vacataire) ?></td>
                <td><?= h($vacataire->nb_heures) ?></td>
                <td><?= h($vacataire->echelle) ?></td>
                <td><?= h($vacataire->dateRecrut) ?></td>
                <td><?= h($vacataire->dateAffectation) ?></td>

       </tr>
        <?php endforeach; ?>
   </tbody>
</table>

</body>
</html>