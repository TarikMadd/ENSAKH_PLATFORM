<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 20px;margin-top: 30px;
    margin-left: 20px;">



<address>
<strong>ROYAUME DU MAROC</strong><br>
<strong>UNIVERSITE HASSAN IER – SETTAT –<br>
ENSA-KHOURIBGA<br><br><br>
</strong></address>
<center><div style="border:solid 4px; width: 200px;padding: 15px"><strong>DECISION</div><br>
<p><i><b>Le Directeur de l'Ecole Nationnale<br> de Sciences Appliquées<br> KHOURIBGA</b></i></p></center><br><br>
<div class="row">
    <div class="col-xs-10" style="margin-left:50px">
      <p>Vu le décret n° 2-97-1053 du 4 Chaoual 1418 (2 Février 1998) relatif aux conditions dans lesquelles peuvent être utilisées, pour les besoins du service, les voitures automobiles personnelles.</p>
      <p>Vu les nécessites de service<br><br>
      <b>Article I :<br>
      Mr: <?php echo $prof['nom_prof']." ".$prof['prenom_prof']; ?></b><br>
      A été autorisé à utiliser pour les besoins du service sa voiture personnelle <br>N° ............ <br>
      puissance fiscal:.......................<br>
      Marque:...............................<br><br>
      <b>Article II :<br></b>
      la distance à parcourir ne peut excéder Vingt Mille Kilomètres (20000Km) par an.<br></p>
    </div>
</div>
<br><br><br>
<p style="margin-left:300px"><b>Khouribga, le </b></p>

<br/><br/>
</body>
<footer><div style=" text-align: center;"  >
</div> </footer>
</html>