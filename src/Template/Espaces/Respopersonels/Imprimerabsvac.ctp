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
                   
        <p><em>  Je vous demande de me permettre de s'absenter durant : <?php echo $_SESSION['demandes'][0]['duree_ab']."jour(s)"?></em></p>
                     
         <p><em> A partir de : <?php echo $_SESSION['demandes'][0]['date_ab']?></em></p>

        <p><em>  Ou à l'heure : 
                    <?php if($_SESSION['demandes'][0]['time_ab']=='00:00:00') echo '-'; else echo $_SESSION['demandes'][0]['time_ab']; ?></em></p>       
        <p><em>  Cause : 
                  <?php if(empty($_SESSION['demandes'][0]['cause']))
                        {
                          echo "Non justifié";
                        }
                        else
                        {
                          echo $_SESSION['demandes'][0]['cause'];
                        }?></em></p>
        <p><em>  Nombre de jours demandé avant pour ce professeur:  <?php echo $_SESSION['nbr_abs'].' jour(s)';?></em></p>

        <p style=" text-align: right;">Signature du professeur : </p> </br>
              

                 
<footer>  <p style="border-radius: 6px;"> Note : Il est interdit au professeur de sortir avant de délivrer une copie de cette certificat . </p> </footer>
                       
</body>
</html>