<?php echo $this->Html->image('logo.png'); ?>

<?php $this->layout = 'AdminLTE.printlandscape'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">
 </br>
<p style=" text-align: right;">    KHOURIBGA le <?php  echo date('d\/m\/y'); ?></p>
<br />
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>

     <h5>
             Informations du grade des professeurs vacataires :
</h5>   
  <div class="panel-body">
           <table ALIGN=center style="text-align: center;vertical-align: middle;" class="table table-bordered">
                    <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                     <th>Categorie</th>
                       <th>Grade</th>
                        <th>echelon present</th>
                      <th>date grade</th>
                      <th>dete rapide</th>
                      <th>date moyen</th>
                      <th>date normal</th>
                      <th>echelle</th>
                      <th>grade prochain</th><th>echelon prochain</th>
                      

                    
                    <tr>
                      <?php
                        for($l=0;$l< count($fonctionnaireG);$l++)
                        {
                          if($l==0) : ?>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['fonctionnaire_id']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['nom_fct']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['prenom_fct']?></td>
                           
                          <?php elseif($fonctionnaireG[$l]['fonctionnaire_id'] != $fonctionnaireG[$l-1]['fonctionnaire_id']): ?>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['fonctionnaire_id']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['nom_fct']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['prenom_fct']?></td>
                          <?php endif; ?>

                     <!-- pour category -->
                 <td><?php $cat=$fonctionnaireG[$l]['categorie'] ;
                   switch($cat){
                   case 0 :
                   $cat="Aide technicien";break;
                   case 1 :
                   $cat="Technicien";break;
                   case 2 :
                   $cat="Aide administrateur";break;
                   case 3:
                   $cat="Administrateur";break;
                   case 4 :
                   $cat="Ingenieur etat";break;
                   case 5:
                   $cat="Ingenieur application";break;
                   case 6 :
                   $cat="Ingenieur application principal";break;
                     case 7 :
                   $cat="Ingenieur etat principal";break;
                    case 8:
                   $cat="Ingenieur en chef";break;


                   }
                   echo $cat;?>
                   </td>

                     <!-- pour grade -->
                      <td><?php echo $fonctionnaireG[$l]['grade']?></td>
                       <!--  -->
                      <td><?php echo $fonctionnaireG[$l]['echelon']?></td>
                       <td><?php echo $fonctionnaireG[$l]['date_grade']?></td>
                        <td><?php echo $fonctionnaireG[$l]['date_echelon_rapide']?></td>
                         <td><?php echo $fonctionnaireG[$l]['date_echelon_moyen']?></td>
                             <td><?php echo $fonctionnaireG[$l]['date_echelon_normal']?></td>
                 <!-- pour echelle-->
                             <td><?php
                         $g= $fonctionnaireG[$l]['grade'];$cat=$fonctionnaireG[$l]['categorie'] ;
                         switch($cat){
                   case 0 :
                              switch($g){
                                case 1 :$echelle=8;break;
                                case 2 :$echelle=7;break;
                                case 3 :$echelle=6;break;
                                case 4 :$echelle=5;break;

                              }
                   break;
                   case 1 :
                   $cat="Technicien";
                   switch($g){
                                case 1 :$echelle=10;break;
                                case 2 :$echelle=9;break;
                                case 3 :$echelle=8;break;
                                case 4 :$echelle=7;break;

                              }
                   break;
                   case 2 :
                   $cat="Aide administrateur";
                      switch($g){
                                case 1 :$echelle=8;break;
                                case 2 :$echelle=7;break;
                                case 3 :$echelle=6;break;
                               

                              }
                   break;
                   case 3:
                   $cat="Administrateur";
                      switch($g){
                                case 1 :$echelle="HE";break;
                                case 2 :$echelle=11;break;
                                case 3 :$echelle=10;break;
                                

                              }
                   break;
                   case 4 :
                   $cat="Ingenieur etat"; $echelle=11;
                   break;
                   case 5:
                   $cat="Ingenieur application";  $echelle=11;
                   break;
                   case 6 :
                   $cat="Ingenieur application principal";
                   $echelle=11;
                   break;
                     case 7 :
                   $cat="Ingenieur etat principal"; $echelle=11;
                   break;
                    case 8:
                   $cat="Ingenieur en chef"; $echelle="HE";
                   break;


                   } echo $echelle;?></td>
                      <!-- pour grade prochain -->
                   <td><?php
                         $g= $fonctionnaireG[$l]['grade'];$cat=$fonctionnaireG[$l]['categorie'] ;$echelon=$fonctionnaireG[$l]['echelon'] ;
                         switch($cat){
                   case 0 :   $cat="Aide technicien";
                              if($echelon ==10){
                                $gp=$g-1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }

                   break;
                   case 1 :
                   $cat="Technicien";
                   if($echelon ==10){
                                $gp=$g-1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 2 :
                   $cat="Aide administrateur";
                      if($echelon ==10){
                                $gp=$g-1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 3:
                   $cat="Administrateur";
                  switch($g){
                  case 1 : 
                                $gp="HE";
                                $echp="HE";

                              break;
                  case 2 :
                       if($echelon ==10){
                                $gp=1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;
                  case 3:
                  if($echelon ==10){
                                $gp=2;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;

                  }
                   break;
                   case 4 :
                   $cat="Ingenieur etat";
                   if($echelon =10){
                                $gp="HE";
                                $echp="HE";

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 5:
                   $cat="Ingenieur application";  
                   if($echelon ==10){
                                $gp="HE";
                                $echp="HE";

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 6 :
                   $cat="Ingenieur application principal";
                
                       if($echelon<10){
                                $gp=$g;
                                $echp=$echelon + 1;

                              }
                
                 
                   break;
                     case 7 :
                   $cat="Ingenieur etat principal"; 
                    switch($g){
                  case 1 : if($echelon ==10){
                                $gp="HE";
                                $echp="HE";

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;
                  case 2 :
                       if($echelon ==10){
                                $gp=1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;
                
                  }
                   break;
                    case 8:
                   $cat="Ingenieur en chef"; $gp="HE"; $echp="HE";
                   break;


                   } echo $gp;?></td>
                    <!-- pour echelon prochain -->

                    <td><?php
                         $g= $fonctionnaireG[$l]['grade'];$cat=$fonctionnaireG[$l]['categorie'] ;$echelon=$fonctionnaireG[$l]['echelon'] ;
                         switch($cat){
                   case 0 :   $cat="Aide technicien";
                              if($echelon ==10){
                                $gp=$g-1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }

                   break;
                   case 1 :
                   $cat="Technicien";
                   if($echelon ==10){
                                $gp=$g-1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 2 :
                   $cat="Aide administrateur";
                      if($echelon ==10){
                                $gp=$g-1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 3:
                   $cat="Administrateur";
                  switch($g){
                  case 1 : 
                                $gp="HE";
                                $echp="HE";

                              break;
                  case 2 :
                       if($echelon ==10){
                                $gp=1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;
                  case 3:
                  if($echelon ==10){
                                $gp=2;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;

                  }
                   break;
                   case 4 :
                   $cat="Ingenieur etat";
                   if($echelon =10){
                                $gp="HE";
                                $echp="HE";

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 5:
                   $cat="Ingenieur application";  
                   if($echelon ==10){
                                $gp="HE";
                                $echp="HE";

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }
                   break;
                   case 6 :
                   $cat="Ingenieur application principal";
                
                       if($echelon<10){
                                $gp=$g;
                                $echp=$echelon + 1;

                              }
                
                 
                   break;
                     case 7 :
                   $cat="Ingenieur etat principal"; 
                    switch($g){
                  case 1 : if($echelon ==10){
                                $gp="HE";
                                $echp="HE";

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;
                  case 2 :
                       if($echelon ==10){
                                $gp=1;
                                $echp=1;

                              }else{
                                $gp=$g; $echp=$echelon+1;
                              }break;
                
                  }
                   break;
                    case 8:
                   $cat="Ingenieur en chef"; $gp="HE"; $echp="HE";
                   break;



                   } echo $echp;?></td>
                        

              
                      </tr>  <?php } ?>
                    
                    
                  </table>
        </div>

</body>
</html>