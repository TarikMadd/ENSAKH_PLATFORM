<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
<style>
    p
    {
        font-size: 14px;
        font-family: "Times New Roman" , Arial ,Impact,  Verdana, sans-serif;
    }
    h1,h2,h3,h5
{
     font-family: "Times New Roman" , Arial ,Impact,  Verdana, sans-serif;
}
h3
{
    font-weight: bold;
}
</style>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">

<div style=" text-align: left;"  >
<?php echo $this->Html->image('header.png',['alt' => 'en tete']); ?>
</div> 


<p style=" text-align: right;">    Khouribga, Le <?=date('d/m/y'); ?></p>
<br />
    <h3 style=" text-align: center;">Le Directeur de l’Ecole Nationale des</h3>
     <h3 style=" text-align: center;">Sciences Appliquées Khouribga</h3>
     <h3 style=" text-align: center;">A</h3>
     <h3 style=" text-align: center;">Monsieur le Directeur des Ressources Humaines <?= $donne[0]['entreprise'];   ?> </h3>  
<br />
     <h5>
            Objet : Recommandation de stage 
</h5>  
     <h5>
   Monsieur le Directeur,          
</h5>  

<p >         L’Ecole Nationale des Sciences Appliquées créée en 2007, est un établissement public relevant de l’université Hassan 1er ayant pour mission principale la formation d’ingénieurs capables d’agir et de superviser toute opération dans le domaine technique. 
</p>

<p>
    Pour réussir cette formation, l’ENSA de Khouribga offre à ses élèves ingénieurs un enseignement moderne semestriel et modulaire alliant les aspects scientifiques et techniques avec les nouvelles orientations technologiques et professionnelles à dominante pratique. 
</p>

<p> Dans le but de développer davantage l’esprit d’initiative chez l’élève ingénieur de notre établissement, nous vous demandons d’accueillir <?php if($donne[0]['code_sexe']=="m"){echo "M ";}else { echo "Mlle ";} ?><span style="font-weight: bold;"><?= $donne[0]['nom_fr'] ?> <?=$donne[0]['prenom_fr']?></span> , <?php if($donne[0]['code_sexe']=="m"){echo "inscrit";}else { echo "inscrite ";} ?>  en <?php if($niveau[0]['id']==1){echo "1re";}elseif($niveau[0]['id']==2){ echo "2ème";}  ?> année des Classes  Préparatoires Intégrées, sous le CNE n°  <span style="font-weight: bold;"><?= $donne[0]['cne'] ?></span> , afin d’effectuer un stage operateur  au sein de votre établissement d’un mois, du <?= h($donne[0]['debut_stage']) ?> au <?= h($donne[0]['fin_stage']) ?> </p>

<p>
Ce stage sera sanctionné par un rapport à déposer à la direction au début de l’année universitaire en cours.
</p>

<p>Nos stagiaires sont tenus de contracter une assurance personnelle et doivent  se conformer à la réglementation de votre établissement notamment en ce qui concerne la discipline et l’horaire.  </p>

<p>En vous remerciant de l’intérêt que vous accordez à notre requête, nous vous prions d’agréer Monsieur le Directeur, l’expression de notre grande considération. </p>
<br> <br/> <br/> <br/>
<footer>
    <div style=" text-align: left;"  >
<?php echo $this->Html->image('footer.png',['alt' => 'en tete']); ?>
</div> 
</footer>
</body>

</html>