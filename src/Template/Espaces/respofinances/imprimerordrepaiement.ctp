<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>

<section style="margin-left: 70px;">
<div class="row" >
<strong>ROYAUME DU MAROC<br/>
UNIVERSITE HASSAN 1er<br/>
ECOLE NATIONALE DES SCIENCES APPLIQUEES<br/>
KHOURIBGA</strong>
</div>
<style>
table, th, td {
   border: 1px solid black;
}
</style>
<div class="row">
<div  class = "text-right" style=" font-style: italic; text-align: right;">
<strong>  ORDRE DE PAIEMENT SUR&nbsp;&nbsp; <br/>ORDRE D’IMPUTATION&nbsp;&nbsp; </strong>
</div>
</div>
<div class="row">
<div class = "pull-right" style=" font-style: oblique;">
<div style=" text-align: center; width: 110px; border:1px dotted black; margin-right: 15px;"><strong>N : <?= $devisdemande['id'] ?></strong></div>
</div>
</div>

<div class="row">
<div  class = "text-right" style=" text-align: right;">
 Du Directeur de l’Ecole Nationale&nbsp;&nbsp; <br/>Des Sciences Appliquées&nbsp;&nbsp; <br/> - Khouribga-&nbsp;&nbsp;
</div>
</div>
<div class="row">
<div style= "text-align:left;">
<strong > &nbsp;&nbsp;&nbsp;Dépenses de l'administration </strong><br/>
<strong > &nbsp;&nbsp;&nbsp;Administration</strong><br/> 
<strong > &nbsp;&nbsp;&nbsp;Charges d'exploitation : -</strong><?= $devisdemande['intitule'] ?><br/>
<strong > &nbsp;&nbsp;&nbsp;Exercice : </strong> <?= $boncommande['exercice']  ?><br/>
<strong > &nbsp;&nbsp;&nbsp;N° de compte  : </strong> 
                    <?php if($ordrepaiement['exercice'] == $boncommande['exercice']){
                             echo $ordrepaiement['num_compte_fournisseur']; $retard = false;
                            }else { echo "68888000"; $retard = true;
                                    } ?><br/>
<strong > &nbsp;&nbsp;&nbsp;Intitule : </strong> 
                    <?php if($retard) echo "RESTE A PAYER AU 31/12/" .$boncommande['exercice'] ." du compte ". $ordrepaiement['num_compte_paiement']." sur  ". $ordrepaiement['exercice'] ."  -" .$devisdemande['intitule']; 
                            else echo $devisdemande['intitule'];  ?><br/>
<strong > &nbsp;&nbsp;&nbsp;Créancier : </strong> <?= $devisdemande['nom_fournisseur'] ?><br/>
<strong > &nbsp;&nbsp;&nbsp;Adresse : </strong> <?= $devisdemande['adresse_fournisseur'] ?><br/>
<strong > &nbsp;&nbsp;&nbsp;Compte N° : </strong> <?= $ordrepaiement['num_compte_fournisseur'] ?><br/><br/>

<div class="row">
<div  style=" font-style: oblique;">
<strong> PIECES JUSTIFICATIVES </strong><br/></div>
<div style=" font-style: italic;">
- Copie du Bon de Commande <?= "N°" .$devisdemande['id'] ."/" .date("y") ?> <br/>
- Copie de la facture <?= $ordrepaiement['num_facture'] ?> <br/>
- Copie du Bon de Livraison   <br/>
- Bon de Réception<br/>
- Copie de Devis<br/>
- Lettres de consultation<br/>
- Procès verbal <br/><br/>
</div>
</div>

<div class="row">
<div>
<center><strong>Arrêté le présent Ordre de paiement à la somme de : </strong><?php echo int2str(number_format($boncommande['prix_total'], 2, '.', ''));?><br/><?= "( " .$boncommande['prix_total'] ." DHS )" ?></center>
</div>
</div>

<div class="row">
<div class="col-md-4">
<div style=" float:left; font-size:80%; text-align: left; width: 230px; height: 180px; border:2px dotted black; margin-left: 15px;">
&nbsp;&nbsp;&nbsp;Transmis au Trésorier Payeur :<br/>
&nbsp;&nbsp;&nbsp;Le : <?php  echo date("d/m/Y"); ?> <br/>
<div style="text-decoration: underline;">&nbsp;&nbsp;&nbsp;L’ordonnateur  Secondaire: </div>
</div></div>
<div class="col-md-4">
<div class = "pull-right" style="font-size:80%; float:right; text-align: left; width: 400px; height: 180px; border:2px dotted black;">
&nbsp;&nbsp;&nbsp;Mode de Règlement : ………………………………<br/>
&nbsp;&nbsp;&nbsp;Chèque N° : ………………………………   <br/>
&nbsp;&nbsp;&nbsp;OV N° :  ……………………………… <br/>
&nbsp;&nbsp;&nbsp;Date de Règlement : ………………………<br/>
<div style="text-decoration: underline;">&nbsp;&nbsp;&nbsp;Visa du Trésorier Payeur :</div><br/>
</div></div></div>




</div>
</div>

</section>
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