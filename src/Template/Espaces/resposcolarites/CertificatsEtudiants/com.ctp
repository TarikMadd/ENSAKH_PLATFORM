<?php 
if(isset($this->request->data['button']) && $this->request->data['button']=='Imprimer'){
    $this->layout = 'AdminLTE.print';
}elseif(isset($this->request->data['button']) && $this->request->data['button']=='Générer PDF'){

}
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
        Cet
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

<h2 style=" text-align: center;">Certificat de scolarité</h2>

<br />
    <h4 style=" text-align: center;">Le Directeur de l’Ecole Nationale des Sciences Appliquées</h4>
     <h4 style=" text-align: center;">Khouribga,soussigné,certifie que</h4>
     
<br />
       
<table border="0" style="width:745px" >
<tr>
<td><p >Mr(Mlle): </p></td>

<td><strong><p style="text-align:right"><?= h($donne[0]['nom_fr'].'  '.$donne[0]['prenom_fr']); ?></p></strong></td>
</tr>

     
   

<tr>
<td><p>né(e)le: </p></td>

<td><p style="text-align:right"><?= h($donne[0]['date_naissance']); ?></p></td>
</tr>





<tr>
<td><p>CNE: </p></td>

<td><p style="text-align:right"><?= h($donne[0]['cne']); ?></p></td>
</tr>

<tr>
<td><p>poursuit ses études en: </p></td>

<td><p style="text-align:right"><?=h($donne[0]['libile']);?></p></td>
</tr>


<tr>
<td><p>au cours de l'année universitaire: </p></td>

<td colspan=3><p style="text-align:right"><?php  $x=date('Y')-1;
echo $x."/".date('Y'); ?></p></td>
</tr>




<tr>
<td><p>Khouribga le: </p></td>

<td><p style="text-align:right"><?php  echo date('y/m/d'); ?></p></td>
</tr>

<tr>

<td colspan=3 align=right><p style="text-align:right">Cachet et signature</p></td></tr>

</table>
<footer>
<br /><p style="text-align:left">N.B:le présent certificat n'est délivré qu'en un seul exemplaire</p>
<p style="text-align:left">Il appartient à l'étudiant(e) d'en faire des copies certifiées conformes</p>



<h3>_________________________________________________________________________________________________________</h3>
<br /><p style="text-align:center"><font size="2px" >Ecole Nationale des Sciences Appliquées, Bd béni Amir, Bp 77, Khouribga - Maroc</font></p>
 <p style="text-align:center"><font size="2px" >Tèl:+212 5 23 49 23 35 /+212 6 18 53 43 72 Fax: +212 5 23 39</font></p>
<p  style="text-align:center"><font size="2px">Email:contact.ensa@uh1.ac.ma -Site web: www.ensa.uh1.ac.ma</font></p>
</footer>
</body>
</html>
       
      

     

         
    

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">	
		
			<form action="<?=$this->Url->build(['controller'=>'Resposcolarites','action'=>'comCertificatsEtudiants',$donne[0]['demande_id']])?>" method="POST">
           <i class="fa fa-print btn btn-default"><input value="Imprimer" name="button" style="border: none; background-color: Transparent;" type="submit"> </i>
            <i class="fa fa-download btn btn-primary pull-right"> <input value="Générer PDF" name="button" style="border: none; background-color: Transparent;" type="submit"> </i>
			</form>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
