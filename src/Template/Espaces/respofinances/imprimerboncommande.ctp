<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>

<body>

<header class="row">
<?php echo $this->Html->image('headerleft.jpg', ['alt' => 'CakePHP', 'align' => 'left']); ?> 
<?php echo $this->Html->image('headerright.jpg', ['alt' => 'CakePHP', 'align' => 'right']); ?> 
<br/><br/>
</header>
<section style="margin-left: 60px;">
<div class="row">
<div style= "text-align:right;">
<strong > EXERCICE :  <?= $data['exercice'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
</div>
</div>
<br/>
<br/>
<div class="row">
<div style= "text-align:center; font-size: 250%;">
<strong > BON DE COMMANDE <?= "N°" .$devisdemande['id'] ."/" .date("y") ?></strong>
</div>
</div>
<br/><br/>
<div class="row">
<div style= "text-align:left;">
<strong > &nbsp;&nbsp;&nbsp;NOM DU  FOURNISSEUR : </strong> <?= $devisdemande['nom_fournisseur'] ?><br/>
<strong > &nbsp;&nbsp;&nbsp;ADDRESSE DU  FOURNISSEUR : </strong> <?= $devisdemande['adresse_fournisseur'] ?>
</div>
</div>
<br/>    




<div>
 <style type="text/css">
 table, th, td {
   border: 1.25px solid black;
}
table {
	  width: 650px;
	   border-collapse: separate;
    empty-cells: hide;
}
th, td {
    padding: 15px;
    text-align: left;
    height: 40px;

}	
<?php $num = 0; $tth = 0; ?>
 </style>   
 <center>
 <table>

                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Article N°
                                    </th>
                                        
                                                                    
                                    <th>
                                    Désigantion
                                    </th>
                                        
                                                                    
                                    <th>
                                    Quantité
                                    </th>
                                        
                                                                    
                                    <th>
                                    Prix Unitaire Ht
                                    </th>
                                    <th>
                                    Prix Totale Ht
                                    </th>
                            </tr>

                            <?php foreach ($devisdemande->articleevents as $articleevents): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?php $num++; echo $num; ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->desigantion)?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($articleevents->quantite) ?>
                                    </td>
                                                                        
                                    <td>
                                   	<?= h($articleevents->prix_unitaire_ht) ?>
                                    </td>
                                    <td>
                                   	<?php $tth=$tth + $articleevents->prix_unitaire_ht * $articleevents->quantite;
                                   	 echo h($articleevents->prix_unitaire_ht * $articleevents->quantite); ?>
                                    </td>
                                                                      
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td><td></td><td></td>
                              <td><center><strong>TOTAL HT</strong></center></td>
                              <td><?= h($tth) ?></td>
                            </tr>
                         <tr>
                         		<td></td><td></td><td></td>
                              <td><center><strong>DONT TVA 20%</strong></center></td>
                              <td><?= h($tth/5) ?></td>
                            </tr>
                            <tr>
                            <td></td><td></td><td></td>
                              <td><center><strong>TOTAL TTC</strong></center></td>
                              <td><?= $data['prix_total'] ?></td>
                            </tr>                        
                                    
                        </tbody>
                    </table>
</div>
<br/>
</center>
<div class="row">
<div><strong> Arrêté le présent bon de commande à la somme de :  </strong> <prix style="text-transform: uppercase;"><?php echo int2str(number_format($data['prix_total'], 2, '.', '')); ?></prix>
</div>
</div>
<br/><br/>
</section>
</body>
<footer><div class="row">
<div style= "text-align:right;">
<strong > Khouribga, le <?php  echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;</strong>
</div>
</div> </footer>
</html>


<?php
function int2str($a)
{
$convert = explode('.',$a);
if (isset($convert[1]) && $convert[1]!=''){
return int2str($convert[0]).' Dirhams'.' et '.int2str($convert[1]).' Centimes' ;
}
if ($a<0) return 'moins '.int2str(-$a);
if ($a<17){
switch ($a){
case 0: return 'zero';
case 1: return 'un';
case 2: return 'deux';
case 3: return 'trois';
case 4: return 'quatre';
case 5: return 'cinq';
case 6: return 'six';
case 7: return 'sept';
case 8: return 'huit';
case 9: return 'neuf';
case 10: return 'dix';
case 11: return 'onze';
case 12: return 'douze';
case 13: return 'treize';
case 14: return 'quatorze';
case 15: return 'quinze';
case 16: return 'seize';
}
} else if ($a<20){
return 'dix-'.int2str($a-10);
} else if ($a<100){
if ($a%10==0){
switch ($a){
case 20: return 'vingt';
case 30: return 'trente';
case 40: return 'quarante';
case 50: return 'cinquante';
case 60: return 'soixante';
case 70: return 'soixante-dix';
case 80: return 'quatre-vingt';
case 90: return 'quatre-vingt-dix';
}
} elseif (substr($a, -1)==1){
if( ((int)($a/10)*10)<70 ){
return int2str((int)($a/10)*10).'-et-un';
} elseif ($a==71) {
return 'soixante-et-onze';
} elseif ($a==81) {
return 'quatre-vingt-un';
} elseif ($a==91) {
return 'quatre-vingt-onze';
}
} elseif ($a<70){
return int2str($a-$a%10).'-'.int2str($a%10);
} elseif ($a<80){
return int2str(60).'-'.int2str($a%20);
} else{
return int2str(80).'-'.int2str($a%20);
}
} else if ($a==100){
return 'cent';
} else if ($a<200){
return int2str(100).' '.int2str($a%100);
} else if ($a<1000){
return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
} else if ($a==1000){
return 'mille';
} else if ($a<2000){
return int2str(1000).' '.int2str($a%1000).' ';
} else if ($a<1000000){
return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000);
}
else if ($a==1000000){
return 'millions';
}
else if ($a<2000000){
return int2str(1000000).' '.int2str($a%1000000).' ';
}
else if ($a<1000000000){
return int2str((int)($a/1000000)).' '.int2str(1000000).' '.int2str($a%1000000);
}
}
?>