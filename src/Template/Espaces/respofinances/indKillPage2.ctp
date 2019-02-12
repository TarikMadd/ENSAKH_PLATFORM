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
ENSA-KHOURIBGA<br>
</strong></address>
<center><div style="border:solid 2px; width: 200px;padding: 15px"><strong>ETAT DES ORDRES DE MISSIONS</div><br>
<p><i><b>Le Directeur de l'école nationnale de sciences appliquées certifie que :</i></b></p></center>
<div class="row">
    <div class="col-xs-10" style="margin-left:150px">
      <p>Mr/Mme: <?php echo $prof['nom_prof']." ".$prof['prenom_prof']; ?><br>Doti:<br>ENSA KHOURIBGA<br>Est autorisé(e) à effectuer les missions ci-dessous indiquées:</strong></p>
    </div>
</div>
<table border="1">
    <tr>
        <th>Date de mission du parcours</th>
        <th>Indication précise du parcours</th>
        <th>Mode de transport</th>
        <th>motifs</th>
    </tr>

    <?php foreach ($resultat as $resultats): ?>
            <tr><td><?=$resultats[1]?> au <?=$resultats[2]?></td><td>KHOURIBGA- <?=$resultats[0]?></td>
            <td><?=$resultats[3]?></td><td>motif</td>
            </tr>
    <?php endforeach; ?>
</table>
<p style="margin-left:300px"><b>Khouribga, le </b></p>

<br/><br/>
</body>
<footer><div style=" text-align: center;"  >
</div> </footer>
</html>