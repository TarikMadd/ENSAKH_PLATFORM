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
<?php echo $this->Html->image('header.png',['alt' => 'en tete']); ?>
</div> 



    <h3 style=" text-align: center;">CONVENTION DE STAGE</h3>
    
<br />
 
     
            
 

<p >
Article 1 : <br/>
La présente convention règle les rapports de l’entreprise : <span style="font-weight: bold;"> <?= $donne[0]['entreprise'];   ?> </span>
Située : 
Ville: ………………………………….. Pays : Maroc                     Tél: 
Représentée par: 
Occupant la fonction de : 

</p>

<p>
  <span style="font-weight: bold;"> ET l’Ecole Nationale des Sciences Appliquées Khouribga</span> (ENSA K) représentée par son Directeur, Monsieur<span style="font-weight: bold;"> Adib JENNANE</span>, concernant le stage de la 1re  Année du Cycle Ingénieur  
</p>

<p> Nom : <span style="font-weight: bold;"><?= $donne[0]['nom_fr'] ?></span>  Prénom : <span style="font-weight: bold;"><?=$donne[0]['prenom_fr']?></span> 
Niveau d’études : 1re  Année Cycle Ingénieur  
Filière : <span style="font-weight: bold;"><?= $donne[0]['libile'] ?> </span>.
Période de stage : ………………………………………………………………………………….
Thème du stage : …………………………………………………………………………………..
   </p>
 
            

<p>
Article 2 : 
Le stage à effectuer est un stage operateur, dont l’objectif est de réaliser un projet complet en situation professionnelle d’ingénieur avec l’appui des compétences et des ressources de la filière.
</p>

   Article 1 :          


<p>Le stage est d’une durée de : ………………………………………………………………….  </p>

   Article 1 :          

<p>Le stage est effectué sous la responsabilité scientifique de : 
Monsieur   ………………….      pour l’organisme d’accueil et 
Professeur  …………………..    pour l’ENSA Khouribga. 
 </p>
 <p>
     Le programme de stage est établi par les deux responsables scientifiques en tenant compte de la formation académique du stagiaire ainsi que de la disponibilité des moyens humains et matériels de l’entreprise. Cette dernière se réserve le droit de réorienter l’apprentissage en fonction des qualifications du stagiaire et du rythme des activités professionnelles
 </p>
 
   Article 1 :          

<p>
    Pendant la durée de son stage, le stagiaire demeure étudiant de l’ENSA K et sera couvert par une assurance contractée par ses soins auprès d’une compagnie d’assurance, qui couvrira les risques que peut impliquer sa présence au sein de l’entreprise.
</p>

   Article 1 :          

<p>
  Le stagiaire ne peut prétendre à aucun salaire de l’entreprise : il pourrait recevoir, soit une indemnité forfaitaire de remboursement de frais, soit, une gratification dont le montant et l’octroi sont laissés à la discrétion de l’entreprise.  
</p>

   Article 1 :          

<p>
  A la fin du séjour au sein de l’entreprise, une grille d’évaluation (ci-jointe) sera remplie par le responsable de stage dans l’entreprise afin d’apprécier le travail, le comportement et les aptitudes du stagiaire.  
</p>

   Article 1 :          

<p>
    Au terme de son stage, l’étudiant doit rédiger son rapport de stage. Il s’agit d’un travail individuel, il est aussi un outil qui permet aux deux responsables scientifiques d’apprécier l’ampleur et la qualité de la mission du stagiaire. Il fera l’objet d’une soutenance et d’une évaluation par un jury.
</p>

   Article 1 :          

<p>
    Le stagiaire étant tenu par le secret professionnel, il s’engage à ne communiquer en aucun cas les informations recueillies lors du stage sans l’accord préalable de la direction de l’entreprise.
</p>

   Article 1 :          

<p>
    Le stage étant obligatoire, le stagiaire est considéré comme ayant donné son consentement aux clauses de la présente convention.


</body>
</html>