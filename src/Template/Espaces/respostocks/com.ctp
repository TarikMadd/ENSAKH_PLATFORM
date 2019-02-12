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
            <?php foreach ($var as $var): ?>
<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP']); ?>
</div> 
<p style=" text-align: left;">N <?= h($atest->id) ?>  </p> 

<p style=" text-align: right;">    KHOURIBGA le <?php  echo date('d\/ m \/ y'); ?></p>
<br />
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>
<br />
     <h3 style=" text-align: center;">A Monsieur le gérant de la société <?= $var["nom_fournisseur"]   ?> <?=  $var["adresse"] ?>

</h3>  
<br />
     <h5>
             Objet : Demande de devis 
</h5>  
     <h5>
   Monsieur,          
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
       J’ai l’honneur de vous demander de bien vouloir nous faire parvenir un devis concernant la liste des articles ci-jointe, par courrier  ou le déposer directement à l’école  au plus tard le  <?= h($atest->delai_limite) ?> .


</p>
<br />
<br />
<p>
   Dans l’attente de votre offre, veuillez agréer, Monsieur, l’expression de nos considérations les plus distinguées. 
</p>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<p>
N.B : Veuillez nous retourner notre lettre de consultation bien cachetée par votre soin.
</p>
<br />
<br />
<br />
<br />
            <?php endforeach; ?>
</body>
</html>