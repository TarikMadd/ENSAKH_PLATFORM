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
<section style="margin-left: 70px;">
<div class="row">
<div class="col-sm-6 invoice-col">
<strong><?= "N°" .$devisdemande['id'] ."/" .date("y") ?></strong>
</div>
</div>
<div class="row">
<div style= "text-align:right;">
<strong > Khouribga, le <?php  echo date("d/m/Y"); ?>&nbsp;&nbsp;&nbsp;</strong>
</div>
</div>
<br/>
<div class="row">
<div style= "text-align:center;">
<strong style="font-size: 110%">LE DIRECTEUR DE L'ECOLE NATIONALE DES<br/>SCIENCES APPLIQUEES KHOUIRBGA <br/>A
     <br/>MONSIEUR  LE GERANT DE LA SOCIETE  <?php   echo $devisdemande['nom_fournisseur'];   ?>    	
     <br/><div style="text-transform: uppercase;"><?= $devisdemande['adresse_fournisseur']; ?></div> 
</strong>
</div>
</div>
<br/><br/>
    
<div class="row">
<strong >
	 &nbsp;&nbsp;&nbsp;&nbsp;OBJET : DEMANDE DE DEVIS 
</strong>
</div>
<br/><br/>
<div class="row">
         <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MONSIEUR,</strong>
</div>
<br/>
<div class="row">
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J’ai l’honneur de vous demander de bien vouloir nous faire parvenir un devis<br/>
         concernant la liste des articles ci-jointe, par courrier ou le déposer directement à <br/> 
         l'école. <br/><br/>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dans l’attente de votre offre, veuillez agréer, Monsieur l’expression de nos<br/>
         considérations les plus distinguées.<br/><br/><br/><br/><br/><br/>
         NB: Veuillez nous retourner notre lettre de consultation bien cachetée par votre soin. 
</div>
<br/><br/><br/><br/>
</section>
<footer class="row">
<?php echo $this->Html->image('footer.jpg', ['alt' => 'CakePHP', 'align' => 'center']); ?> 
<br/><br/>
</footer>
