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
        Présenté par: <?= $prof['nom_prof']; ?><br>
        Grade: <br>
        Etablissement : <?= $prof['codeEtablissement']; ?><br>
        Indice : <br>
      </div>
      <div class="col-xs-5">
        Prenom : <?= $prof['prenom_prof']; ?> <br>
        Echelon : <?= $prof['echelon']; ?><br>   
        Groupe: : <br>   
        Echelle : <?= $prof['echelle']; ?><br>   
      </div>
    </div>
<table border="1">
    <tr>
        <th>Date de mission du parcours</th>
        <th>Parcours</th>
        <th>Mode de transport</th>
        <th>Taux de base</th>
        <th>Idemnité appliquée</th>
        <th>Montant de l'indemnité</th>
    </tr>

    <?php foreach ($resultat as $resultats): ?>
            <tr><td><?=$resultats[1]?> au <?=$resultats[2]?></td><td>KHOURIBGA- <?=$resultats[0]?></td>
            <td><?=$resultats[3]?></td><td><?=$resultats[4]?></td><td><?=$resultats[5]?></td><td><?=$resultats[6]?></td>
            </tr>
    <?php endforeach; ?>
    <tr><td colspan="5" style="text-align:center;"><b>total</b></td><td><?=$t ?></td></tr>
</table>

<div class="row">
      <div class="col-xs-5" style="border: solid 2px;height: 250px">
        <strong>Le Doyen</strong> 
        Certifie que les déplacements mentionnés au présent état ont eu lieu pour les besoins de service.<br>Arrêté à la somme de :<b><?=$t?> Dhs</b><br>
        <b>Khouribga, le</b> 
      </div>
      <div class="col-xs-5" style="height: 250px">
        Arrêté le présent Etat à la somme de : <b><?=$t?> Dhs</b><br>
        par le soussigné qui atteste n’avoir bénéficié d’aucune réduction sur les sommes dont il demande le remboursement <br>   
        <b>A Khouribga, le : <br>   
        Signature du bénéficiaire:</b> <br>   
      </div>
      <div class="col-xs-5" style="border: solid 2px;">
        Arrêté par nous <b>L'ordonnateur Secondaire</b> à la somme de :<b><?=$t?> Dhs</b><br>
        A Khouribga, le : <br> <br><br><br><br><br>     
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