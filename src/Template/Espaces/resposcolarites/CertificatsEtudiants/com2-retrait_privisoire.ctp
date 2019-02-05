<?php 
if(isset($this->request->data['button']) && $this->request->data['button']=='Imprimer'){
$this->layout = 'AdminLTE.print';}
?>                                

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Certificats #<small><?= $donne[0]['demande_id'] ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $this->Url->build(['controller'=>'resposcolarites','action'=>'indexCertificats']) ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        Cette page est pour l'impréssion et le téléchargement
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
     
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body>

 

<div style=" text-align: center"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP','style'=>'border: 1px black;']); ?>
</div> 
<h4>__________________________________________________________________________</h4>
<br />
    <U><B><h3 style=" text-align: center;">Demande de Retrait Provisoire</h3></B></U>
     <U><B><h3 style=" text-align: center;"> du Baccalauréat</h3></B></U>
     
<br />
<p style="margin-left:60px;"><font style="line-height:3px;">Nom et Prénom:<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?> <?=  h($donne[0]['nom_fr'].'  '.$donne[0]['prenom_fr']); ?><br/><br/>
 CNE :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?> <?=  h($donne[0]['cne']); ?><br/><br/>
Filiére  :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?><?=  h($donne[0]['libile']); ?><br/><br/>
Semestre :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?><?= h($donne[0]['semestres']);?><br/><br/>
CIN:<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?><?= h($donne[0]['cin']);?><br/><br/>
N° APOGEE :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?><?= h($donne[0]['apogee']);?> 
</font></p>
  


<h4 style="text-align:center">A Monsieur le Directeur de l’Ecole Nationale des Sciences </h4>
<h4 style="text-align:center">Appliquées de Khouribga</h4>

<div style="margin-left:60px;">
<p ><font style="line-height:3px;"> <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?>J’ai l’honneur de vous demander de bien vouloir accepter ma demande de retirer mon <br/>
 Baccalauréat et ma licence provisoirement, je m’engage à les rendre dans un délai de  <br />
 48 heures, passé ce délai,le présent retrait prendra un caractère définitif, et aucune réinscription n’est acceptée.</p>
</div>
<p style="text-align:center">Veuillez agréer Mr le Directeur, mes respects les plus sincères.</p>
<p style="text-align:center">Khouribga le :<?php  echo date('d/m/y'); ?></p>

<p style="text-align:right">Signature de l'élève</p>

<div style=" text-align: left;"  >
<?php echo $this->Html->image('footer.png', ['alt' => 'CakePHP','style'=>'border: 1px black;']); ?>
</div> 


</body>
</html>


<div class="row no-print">
        <div class="col-xs-12">	
		
			<form action="<?=$this->Url->build(['controller'=>'Resposcolarites','action'=>'comCertificatsEtudiants',$donne[0]['demande_id']])?>" method="POST">
           <i class="fa fa-print btn btn-default"><input value="Imprimer" name="button" style="border: none; background-color: Transparent;" type="submit"> </i>
			</form>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Générer PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>