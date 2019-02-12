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
             Liste des Présélectionnés :
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
  <table class="table table-bordered" text>
   <thead> <!-- En-tête du tableau -->
       <tr class="bg-primary">
           <th class="bg-primary">Code</th>
           <th class="bg-primary">CNE</th>
           <th class="bg-primary">CIN</th>
           <th class="bg-primary">Nom</th>
           <th class="bg-primary">Prénom</th>
           
           <th class="bg-primary">Concours</th>
           <th class="bg-primary">Admis</th>
           <th class="bg-primary">Attente</th>
       </tr>
   </thead>

   <tbody> <!-- Corps du tableau -->
            <?php foreach ($preinscriptions as $preinscription): ?>
              <tr >
                <td><?= h($preinscription->id) ?></td>
                <td ><?= h($preinscription->cne) ?></td>
                <td ><?= h($preinscription->cin) ?></td>
                <td ><?= h($preinscription->nom_fr) ?></td>
                <td ><?= h($preinscription->prenom_fr) ?></td>
                
                <td ><?= $preinscription->has('concour') ? $preinscription->concour->niveau->libile." ".$preinscription->concour->filiere->libile : '' ?></td>
                <td border="1px 1px solid black"><input type="checkbox" name="admis"/></td>
                <td border="1px 1px solid black"><input type="checkbox" name="attetnte"/></td>

       </tr>
        <?php endforeach; ?>
   </tbody>
</table>
 <div >
    <div style="float:left;  margin-right: 20px;">École National des Sciences AppliquEes  Khouribga<br />
        ENSA, Bd. Beni Amir, B.P. 77, Khouribga</div>
    <div>Tél.  <span dir="ltr"> </span>+212 6 61 15 07 21 <br /> +212 6 64 16 66 30<br />
  Site web: <a rel="nofollow" rel="noreferrer"rel="nofollow" href="http://www.ensa.uh1.ac.ma/" target="_blank">www.ensa.uh1.ac.ma</a></div>
 </div>
</body>

</html>