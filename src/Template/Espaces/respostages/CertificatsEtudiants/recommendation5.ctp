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
            Objet : Recommandation pour stage de fin d’études.
</h5>  
     <h5>
   Monsieur le Directeur,          
</h5>  

<p >         L’Ecole Nationale des Sciences Appliquées, est un établissement public appartenant à l’université Hassan 1er et ayant pour objectif principale la formation d’ingénieurs capables d’agir et de superviser toutes opérations dans les domaines techniques et managériaux. 
</p>

<p>
    Pour réussir cette formation, l’ENSA de Khouribga offre à ses élèves ingénieurs un enseignement scientifique et technique moderne en adéquation avec les nouvelles orientations technologiques et économiques du monde professionnel.
</p>
<p>
    Afin de compléter leur cursus, nos élèves ingénieurs en dernière année sont tenus d’effectuer en entreprise, un stage de fin d’études d’une durée minimale de 4 mois à compter du <?= h($donne[0]['debut_stage']) ?>

</p>
<p>
        A cet effet, nous vous demandons d’accueillir <?php if($donne[0]['code_sexe']=="m"){echo "M ";}else { echo "Mlle ";} ?><span style="font-weight: bold;"><?= $donne[0]['nom_fr'] ?> <?=$donne[0]['prenom_fr']?></span> , <?php if($donne[0]['code_sexe']=="m"){echo "inscrit";}else { echo "inscrite ";} ?>  en 3ème année du Cycle Ingénieur, Filière <span style="font-weight: bold;"><?= $donne[0]['libile'] ?> </span> sous CNE n° <span style="font-weight: bold;"><?= $donne[0]['cne'] ?></span>, afin d’effectuer un stage au sein de votre établissement.
</p>

    <p> 
Un rapport pour l’évaluation du PFE sera remis à la direction de l’Ecole et une soutenance devant un jury aura lieu à la fin du stage.
    </p>

<p>
Nos stagiaires sont tenus de contracter une assurance personnelle et doivent se conformer à la réglementation de votre établissement notamment en ce qui concerne la discipline et l’horaire.
</p>

<p>En vous remerciant de l’intérêt que vous accordez à notre requête, nous vous prions d’agréer  Monsieur le  Directeur, l’expression de notre grande considération. </p>
<p style="font-weight: bold; text-align: center;" >
   <span style="text-decoration: underline;"> N.B </span> : L’Etudiant entame son PFE après validation du semestre 5.
</p>
<footer>
    <div style=" text-align: left;"  >
<?php echo $this->Html->image('footer.png',['alt' => 'en tete']); ?>
</div> 
</footer>
</body>
</html>