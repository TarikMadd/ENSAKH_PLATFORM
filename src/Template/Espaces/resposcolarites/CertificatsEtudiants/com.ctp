<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style=" margin-right: 75px;
    margin-left: 75px;  width:750px;
	  height:1000px;" >

<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP']); ?>
</div> 
<h3>_________________________________________________________________________________________________________</h3>

<h2 style=" text-align: center;">Certificat de scolarité</h2>

<br />
    <h4 style=" text-align: center;">Le Directeur de l’Ecole Nationale des Sciences Appliquées</h4>
     <h4 style=" text-align: center;">Khouribga,soussigné,certifie que</h4>
     
<br />
       
<table border="0" style="width:745px">
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
<br /><p style="text-align:left">N.B:le présent certificat n'est délivré qu'en un seul exemplaire</p>
<p style="text-align:left">Il appartient à l'étudiant(e) d'en faire des copies certifiées conformes</p>



<h3>_________________________________________________________________________________________________________</h3>
<br /><p style="text-align:center"><font size="2px" >Ecole Nationale des Sciences Appliquées, Bd béni Amir, Bp 77, Khouribga - Maroc</font></p>
 <p style="text-align:center"><font size="2px" >Tèl:+212 5 23 49 23 35 /+212 6 18 53 43 72 Fax: +212 5 23 39</font></p>
<p  style="text-align:center"><font size="2px">Email:contact.ensa@uh1.ac.ma -Site web: www.ensa.uh1.ac.ma</font></p>

</body>
</html>
