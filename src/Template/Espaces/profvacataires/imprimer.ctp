<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body>
	<p style=" text-align: right;">    KHOURIBGA le : <?php  echo date('d\/m\/y'); ?></p>  <p style=" text-align: left;">  Université Hassan 1er </br>Ecole Nationale des Sciences Appliquées     </p>
    <h2 style=" text-align: center;"> <strong>Permission d'absence</strong></h2></br>
                  
        <p><em>  Nom & Prenom :      <?php echo $_SESSION['demandes'][0]['nom_vacataire']." ".$_SESSION['demandes'][0]['prenom_vacataire']?> </em> </p>

         <p><em> Grade : <?php echo $_SESSION['demandes'][0]['sous_grade']?></em></p>

       
        <?php foreach ($absences as $absence): ?>         
        <p><em>  Je vous demande de me permettre de s'absenter durant : <?php echo $absence['duree_ab']."jour(s)"?></em></p>
                     
         <p><em> A partir de : <?php echo $absence['date_ab']?></em></p>

        <p><em>  Ou à l'heure : 
                    <?php if($absence['time_ab']=='00:00:00') echo '-'; else echo $absence['time_ab']; ?></em></p>       
        <p><em>  Cause : 
                  <?php if(empty($absence['cause']))
                        {
                        	echo "Non justifié";
                        }
                        else
                        {
                        	echo $absence['cause'];
                        }?></em></p>
        <?php endforeach; ?>
        <p><em>  Nombre de jours demandé avant pour ce professeur :  <?php echo $_SESSION['nbr_abs'].' jour(s)';?></em></p>

        <p style=" text-align: right;">Signature du professeur : </p> </br>
              

                 
<footer>  <p style="border-radius: 6px;"> Note : Il est interdit au professeur de sortir avant de délivrer une copie de cette certificat . </p> </footer>
                       
</body>
</html>