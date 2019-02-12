<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">

<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP']); ?>
</div> </br>
<p style=" text-align: right;">    KHOURIBGA le <?php  echo date('d\/m\/y'); ?></p>
<br />
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>
<br />
<br />
     <h5>
             Informations Etudiant :
</h5>   

<p >  
<?php

$day  = date('d');
$day=$day+5;
$year = date('y');
$month  = date('m ');;
if($day>29)
{
	$day=$day-29;
$month=$month+1;
	if($month>12)
	{
		$year=$year+1;
	}

}
?>
           <!-- /.box-header -->
        <div class="box-body table-responsive  no-padding">
          <table class="table table-bordered">
            <tr >
              <th class="active">  </th>
              <th class="active">Nom</th>
              <th class="active">Prenom</th>
              <th class="active">Code Apogée</th>
              <th class="active">CNE</th>
              <th class="active">CIN</th>
                                    
            <?php foreach ($etudiants->toArray() as $etudiant): ?>
            <?php 
                //$fil="";

                //foreach ($etudiant->Etudiers as $etudiers) {
                  //  $fil=$etudiers->groupe->niveau->libile . " " .$etudiers->groupe->filiere->libile;
                //} ?>

              <tr>
               <?php 
               if($etudiant->photo){
                    $image = ltrim(str_replace("\\", "/", $etudiant->photo),'/img');
               }else{
                    $image = "Etudiants\profile.jpg";
               }
                

               ?>
                <td ><?php echo $this->Html->image($image, array('width' => 45, 'height' => 50)); ?></td>
                <td ><?= h($etudiant->nom_fr) ?></td>
                <td><?= h($etudiant->prenom_fr) ?></td>
                <td><?= h($etudiant->apogee) ?></td>
                <td><?= h($etudiant->cne) ?></td>
                <td><?= h($etudiant->cin) ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>

</body>
</html>