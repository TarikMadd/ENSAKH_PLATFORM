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
        Cette page c'est pour l'impression et le téléchargement
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
<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP','style'=>'border: 1px black;']); ?>
</div> 

<h2 style=" text-align: center;">Attestation de réussite</h2>

<br />
    <h4 style=" text-align: center;">Le Directeur de l’Ecole Nationale des Sciences </h4>
     <h4 style=" text-align: center;">Appliquées de Khouribga(ENSAK),atteste que :</h4>
     
<br />
  


           <h4>        Mr(Mlle): </h4>

<strong><h4 style="text-align:right"><?= h($donne[0]['nom_fr'].'  '.$donne[0]['prenom_fr']); ?></h4></strong>


     
   <br />


<h4>né(e)le: </h4>

<h4 style="text-align:right"><?= h($donne[0]['date_naissance']); ?> à  <?=  h($donne[0]['ville_naissance_fr']); ?></h4>

 <br />



<h4>CNE: </h4>

<h4 style="text-align:right"><?= h($donne[0]['cne']); ?></h4>

 <br />

<h3><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?>A validé les examens de <?=  h($donne[0]['libile']) ;  ?>
<?php echo '&nbsp;&nbsp;'; ?>au titre de l’année universitaire : <?php  $x=date('Y')-1;
echo $x."/".date('Y'); ?></h3> <br />

<h3>La présente attestation est délivrée à l’intéressé(e) pour faire valoir ce que de droit.
</h3>

<br />
<br />


<h4>Khouribga le: </h4>

<h4><?php  echo date('y/m/d'); ?></h4>


<div style=" text-align: left;"  >
<?php echo $this->Html->image('footer.png', ['alt' => 'CakePHP','style'=>'border: 1px black;']); ?>
</div> 





</body>
</html>
       
      

     

         
    

      <!-- this row will not appear when printing -->
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