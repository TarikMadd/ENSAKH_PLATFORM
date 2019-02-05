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
<div class="row">
<div style= "text-align:right;">
<strong > EXERCICE :  <?php echo "20" .date("y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
</div>
</div>
<br/>
<div class="row">
<div style= "text-align:center; font-size: 150%;">
<strong > ORDRE DE VIREMENT <?= " N°" .$devisdemande['id'] ."/" .date("y") ?></strong>
</div>
</div>
<br/><br/>
<div class="row">
<div style= "text-align:left;">
<strong > &nbsp;&nbsp;&nbsp;Par le débit de notre compte N°<?php if($ordrepaiement['exercice'] == $boncommande['exercice']){
                             echo $ordrepaiement['num_compte_fournisseur']; $retard = false;
                            }else { echo "68888000"; $retard = true;
                                    } ?> ouvert à la trésorerie régionale de Khouribga, veuillez porter au crédit des comptes intitulés et détaillés ci-dessous: </strong>
<prix style="text-transform: uppercase;"><?php echo int2str(number_format($boncommande['prix_total'], 2, '.', '')); ?></prix><br/>
</div>
</div>

<center>
<table style="font-style: oblique;">
                        <tbody>

                            <tr>
                                                                    
                                    <th>
                                    Non et Prénom
                                    </th>
                                        
                                                                    
                                    <th>
                                    Banque
                                    </th>
                                        
                                                                    
                                    <th>
                                    IF
                                    </th>
                                        
                                                                    
                                    <th>
                                    Adresse
                                    </th>
                                    <th>
                                    N° Compte
                                    </th>
                                    <th>
                                    Montant
                                    </th>
                                    <th>
                                    Objet de virement
                                    </th>
                            </tr>
                                <tr>
                                                                        
                                    <td>
                                    <?php  echo $devisdemande['nom_fournisseur'] ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($ordrepaiement['banque']) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($ordrepaiement['identificateur_fiscale']) ?>
                                    </td>
                                                                        
                                    <td>
                                   	<?= h($devisdemande['adresse_fournisseur']) ?>
                                    </td>
                                    <td>
                                   	<?= h($ordrepaiement['num_compte_fournisseur']) ?>
                                    </td>
                                    <td>
                                   	<?php echo $boncommande['prix_total'] ?>
                                    </td>
                                    <td>
                                   	<?= "Réglet de la facture N°" .$ordrepaiement['num_facture'] ." du 32/12/" .$boncommande['exercice'] ?>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><?php $newDate = date("d-m-Y", strtotime($ordrepaiement['date'])); echo h("OP N°" .$devisdemande['id'] ." DU " .$newDate); ?></td>
                                    </tr>
                                    <tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td><?php echo "N° de compte  "; if($ordrepaiement['exercice'] == $boncommande['exercice']){
                             echo $ordrepaiement['num_compte_fournisseur']; $retard = false;
                            }else { echo "68888000"; $retard = true;} ?>
 		                           </td>
                                    </tr><tr>
                                    <td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td></td><td></td><td></td><td></td><td><strong>TOTAL</strong></td><td>	<?php echo $boncommande['prix_total'] ?></td>
                                    <td></td>
                                    </tr>
                        </tbody>
                    </table>
</center>											
<div class="row">
<div style= "text-align:right;">
<strong > Khouribga, le <?php  echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;</strong>
</div>
</div>
<div class="row">
<div style= "text-align:left;">&nbsp;&nbsp;&nbsp;
<strong style="text-decoration: underline;">L'Ordonnateur Secondaire :</strong>
</div>
</div>
<div class="row">
<div style= "text-align:right;">
<strong style="text-decoration: underline;">Le Fondé de pouvoirs :</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>

</section>

<style type="text/css">
 table, th, td {
   border: 1.25px solid black;
}
table {
	  width: 100%;

}
th, td {
    padding: 15px;
    text-align: left;
    height: 40px;

}	
<?php $num = 0; $tth = 0; ?>
 </style> 



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