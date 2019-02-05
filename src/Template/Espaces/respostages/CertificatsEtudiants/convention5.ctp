<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
<div style=" text-align: left;"  >
<?php echo $this->Html->image('header.png',['alt' => 'CakePHP','style'=>'border: 1px black;']); ?>
</div> 
<style>
  p{
    font-size: 14px;
        font-family: "Times New Roman" , Arial ,Impact,  Verdana, sans-serif;
  }
  h3
{
    font-weight: bold;
}
.article{
font-weight: bold; text-decoration: underline;
color: #8000ff;
}
</style>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px; ">





    <h3 style=" text-align: center; font-size: 16px;">CONVENTION DE STAGE</h3>
    

 
     
          
  

<p>
 <span class="article">Article 1 :</span>  <br/>
La présente convention règle les rapports de l’entreprise : <span style="font-weight: bold;"> <?= $donne[0]['entreprise'];   ?> </span> <br/>
Située : <br/>
Ville: ………………………………….. Pays : <span style="font-weight: bold;">  Maroc</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                   Tél: <br/>
Représentée par: <br/>
Occupant la fonction de : <br/><br/>


   <span style="font-weight: bold;"> ET l’Ecole Nationale des Sciences Appliquées Khouribga</span> (ENSA K) représentée par son Directeur, Monsieur<span style="font-weight: bold;"> Adib JENNANE</span>, concernant le stage de la 3ème  Année du Cycle Ingénieur  
</p>

<p> Nom : <span style="font-weight: bold;"><?= $donne[0]['nom_fr'] ?></span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prénom : <span style="font-weight: bold;"><?=$donne[0]['prenom_fr']?></span><br/>
Niveau d’études : <span style="font-weight: bold;"> 3ème  Année Cycle Ingénieur  </span>   <br/> 
Filière :<span style="font-weight: bold;"><?= $donne[0]['libile'] ?> </span>. <br/> 
Période de stage : du <?= h($donne[0]['debut_stage']) ?> au <?= h($donne[0]['fin_stage']) ?><br/> 
Thème du stage :<span style="font-weight: bold;"> <?= h($donne[0]['theme_stage']) ?> </span> <br/> 
   </p>
 
            
 
<p>
<span class="article"> Article 2 :</span> <br/>
Le stage à effectuer est un stage d’Ingénieur Adjoint, dont l’objectif est de réaliser un projet complet en situation professionnelle d’ingénieur avec l’appui des compétences et des ressources de la filière.
</p>

          
 

<p><span class="article"> Article 3 : </span> <br/> 
Le stage est d’une durée de :<span style="font-weight: bold;"> <?=h($donne[0]['duree_stage']) ?> Mois </span> </p>

           
 
<p><span class="article"> Article 4 :</span> <br/> 
Le stage est effectué sous la responsabilité scientifique de :  <br/> 
Monsieur   ………………….      pour l’organisme d’accueil et  <br/> 
Professeur <span style="font-weight: bold;"> <?= h($prof[0]['prenom_prof']) ?> <?= h($prof[0]['nom_prof']) ?> </span>  pour l’ENSA Khouribga.  <br/>
 <br/>
     Le programme de stage est établi par les deux responsables scientifiques en tenant compte de la formation académique du stagiaire ainsi que de la disponibilité des moyens humains et matériels de l’entreprise. Cette dernière se réserve le droit de réorienter l’apprentissage en fonction des qualifications du stagiaire et du rythme des activités professionnelles
 </p>
 
          
 
<p> <span class="article">  Article 5 :</span> <br/>
    Pendant la durée de son stage, le stagiaire demeure étudiant de l’ENSA K et sera couvert par une assurance contractée par ses soins auprès d’une compagnie d’assurance, qui couvrira les risques que peut impliquer sa présence au sein de l’entreprise.
</p> <br/>
 
     <div style=" text-align: left;"  >
<?php echo $this->Html->image('footer.png',['alt' => 'en tete']); ?>
</div>  
<div style=" text-align: left;"  >
<?php echo $this->Html->image('header.png',['alt' => 'CakePHP','style'=>'border: 1px black;']); ?>
</div>     
 
<p>  <span class="article"> Article 6 : </span> <br/>
    Pendant son stage, le stagiaire est soumis à la discipline générale et au règlement intérieur de l’entreprise, notamment en ce qui concerne le secret professionnel et l’organisation du travail (horaires). En cas de non respect de ces dispositions, l’entreprise se réserve le droit de mettre fin au stage après en avoir prévenu le directeur de l’ENSA K. 
</p>

 <span class="article">   Article 7 : </span>  <br/>       
 
<p>
  Le stagiaire ne peut prétendre à aucun salaire de l’entreprise : il pourrait recevoir, soit une indemnité forfaitaire de remboursement de frais, soit, une gratification dont le montant et l’octroi sont laissés à la discrétion de l’entreprise.  
</p>

 <span class="article">   Article 8 :</span>  <br/>        
 
<p>
  A la fin du séjour au sein de l’entreprise, une grille d’évaluation (ci-jointe) sera remplie par le responsable de stage dans l’entreprise afin d’apprécier le travail, le comportement et les aptitudes du stagiaire.  
</p>

<span class="article">    Article 9 :   </span>       
 
<p>
    Au terme de son stage, l’étudiant doit rédiger son rapport de stage. Il s’agit d’un travail individuel, il est aussi un outil qui permet aux deux responsables scientifiques d’apprécier l’ampleur et la qualité de la mission du stagiaire. Il fera l’objet d’une soutenance et d’une évaluation par un jury.
</p>

 <span class="article">   Article 10 :    </span>      
 
<p>
    Le stagiaire étant tenu par le secret professionnel, il s’engage à ne communiquer en aucun cas les informations recueillies lors du stage sans l’accord préalable de la direction de l’entreprise.
</p>

 <span class="article">   Article 11 :  </span>        
 
<p>
    Le stage étant obligatoire, le stagiaire est considéré comme ayant donné son consentement aux clauses de la présente convention.

</p>
    <p style="font-weight: bold; text-align: center;"> LU ET APPROUVE </p>
    
   <p style="font-weight: bold;">Le Directeur de l’ENSA
Khouribga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Le Directeur de l’Entreprise </p><br/><br/><br/><br/><br/>
<p style="font-weight: bold;">Le Responsable pédagogique&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; L'Etudiant  stagiaire </p><br/>
    
<footer>
    <div style=" text-align: left;"  >
<?php echo $this->Html->image('footer.png',['alt' => 'pieds']); ?>
</div> 
</footer>
</body>
</html>