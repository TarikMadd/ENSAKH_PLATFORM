<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 90px;margin-top: 20px;
    margin-left: 90px;">



<address>
<strong>ROYAUME DU MAROC</strong><br>
<strong>UNIVERSITE HASSAN IER – SETTAT –</strong></address>

    <center>
        <b><i>Etat des sommes dues pour indemnités de<br>
        Déplacement à l’intérieur du Royaume.<br></i></b>
    </center>
    <div class="row">
      <div class="col-xs-5">
        Présenté par: <?= $prof['nom_prof']; ?> <?= $prof['prenom_prof']; ?><br>
        Grade: <br>
        Etablissement : <?= $prof['codeEtablissement']; ?><br>
        Indice : <br>
      </div>
      <div class="col-xs-5">
        Echelon : <?= $prof['echelon']; ?><br>    
        Echelle : <?= $prof['echelle']; ?><br>   
      </div>
    </div>
<table border="1">
    <tr>
        <th>Date de mission du parcours</th>
        <th>Parcours</th>
        <th>Distance</th>
        <th>Idemnité kilométrique</th>
    </tr>

    <?php foreach ($resultat as $resultats): ?>
            <tr><td><?=$resultats[0]?> au <?=$resultats[1]?></td><td>KHOURIBGA- <?=$resultats[2]?> et retour</td>
                <td><?=$resultats[3]?> X 2</td><td><?=$resultats[4]?></td>
            </tr>
    <?php endforeach; ?>
    <tr><td colspan="3" style="text-align:center;"><b>total</b></td><td><?=$t ?></td></tr>
</table>
<br>
<div class="row">
      <div class="col-xs-12">
        Arrêté à la somme de :<strong><?=$t ?> Dh</strong> <br>
        Par le soussigné qui atteste n’avoir bénéficié d’aucune réduction de tarif à quelque titre que ce soit sur les sommes dont il demande le remboursement.<br>
        L'intéressé : <b><?= $prof['nom_prof']; ?> <?= $prof['prenom_prof']; ?>  Khouribga, le</b> <br><br>
      </div>

      <div class="col-xs-5" >
        Certifie que les déplacements mentionnés
        Arrêté par nous, Ordonnateur à la somme de:
        au présent état ont lieu pour les
        besoins du service   
      </div>
      <div class="col-xs-2" ></div>
      <div class="col-xs-5">
        Arrêté par nous <b>L'ordonnateur Secondaire</b> à la somme de :<b><?=$t?> Dhs</b><br>
        A Khouribga, le :   
      </div>
</div>

<!--
<p style=" text-align: left;"> <?= "N°" .$devisdemande['id'] ."/" .date("y") ?></p>
<p style=" text-align: right;">    KHOURIBGA le <?php  echo date("d/m/Y"); ?></p>
<br />-->

<br/><br/>
</body>
<footer><div style=" text-align: center;"  >
</div> </footer>
</html>