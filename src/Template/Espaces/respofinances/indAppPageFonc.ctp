<?php $this->layout = 'AdminLTE.print';?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 20px;margin-top: 20px;
    margin-left: 20px;">



<address>
<strong>ROYAUME DU MAROC</strong><br>
<strong>UNIVERSITE HASSAN IER – SETTAT –<br>
ENSA-KHOURIBGA</strong></address>

<div class="row">
      <div class="col-xs-5">
        
            <b><i>Dépense de l'administration<br>
            Administration<br>
            Autre charges externes</i></b>
        
      </div>  
      <div class="col-xs-7">
        <center>
            <b><i>Ordre de paiement<br>
            <table><th><td style="width:80%">N°</td><td style="width:10%"></td></th></table>
            Sur l'ordre de l'imputation de<br>
            Monsieur le Doyen de<br>
            Khouribga</i></b>
        </center>
        <br><br>
      </div>
      <div class="col-xs-11">
        Exercice &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <br>
        N° de compte :<br>   
        Intitulé &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Indemnités de déplacement à l'intérieur du Royaume<br><br><br>
        Bénéficiaire &nbsp;&nbsp;&nbsp;:<b> <?php echo $fonc['nom_fct']." ".$fonc['prenom_fct']; ?></b><br>
        Adresse &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>ENSA KHOURIBGA</b><br>
        Domiciliation&nbsp;&nbsp; :<br><br>
        <b>Pièces justificatives:</b>
        <ul><li>copie de l’état des sommes dues</li><li>copie de l’Ordre de mission</li></ul>
        Arrêté le présent ordre de paiement à la somme de :<b><?=$t?> Dh</b><br><br>
      <div class="col-xs-6" style="border: solid 2px;height: 270px;">
        <b>TRANSMIS AU TRESORIER PAYEUR</b><br>
        le: <br>
        <b>Signature de l'ordonnateur secondaire </b><br>
      </div>
      <div class="col-xs-1"></div>
      <div class="col-xs-5" style="border: solid 2px;height: 270px">
         <b>MODE DE PAIEMENT</b><br>
          Chèque N°: ............................<br>
          OVN°.......................................<br>..................................................<br>
          Date du règlement :<br>..................................................<br>
          Visa du Trésorier Payeur:<br>..................................................<br>
          ..................................................<br>
          ..................................................<br>
          ..................................................<br>
      </div>
      </div>
</div>
<br/><br/>
</body>
<footer><div style=" text-align: center;"  >
</div> </footer>
</html>