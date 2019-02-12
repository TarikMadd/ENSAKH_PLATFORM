<?php echo $this->Html->css('teacher'); ?>
<?php 

switch($data['PROF_GRADE'][0]['categorie']){
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

$echelon = $data['PROF_GRADE'][0]['echelon'];
$g =  $data['PROF_GRADE'][0]['grade'];
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


                   }



?>
<section class="content">
    
    
    <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username"> <?php echo $data['PROF_DATA'][0]['nom_fct'].' '.$data['PROF_DATA'][0]['prenom_fct']; ?> </h3>
              <h5 class="widget-user-desc">Fonctionnaire</h5>
            </div>
            <div class="widget-user-image">
                <?php echo $this->Html->image('teacher.png', array('alt' => 'teacher', 'class'=> 'img-circle')); ?>
            </div>

            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a href="#">Age <span class="pull-right badge bg-blue"><?php echo $data['PROF_DATA'][0]['age']?></span></a></li>
                  <li><a href="#">Somme <span class="pull-right badge bg-blue"><?php echo $data['PROF_DATA'][0]['somme']?></span></a></li>
                  <li><a href="#">Email <span class="pull-right badge bg-aqua"><?php echo $data['PROF_DATA'][0]['email']?></span></a></li>
                  <li><a href="#">Phone <span class="pull-right badge bg-green"><?php echo $data['PROF_DATA'][0]['phone']?></span></a></li>
                  <li><a href="#">CIN <span class="pull-right badge bg-green"><?php echo $data['PROF_DATA'][0]['CIN']?></span></a></li>
                  <li><a href="#">Categorie <span class="pull-right badge bg-red"><?php echo $cat?></span></a></li>
                  <li><a href="#">Grade <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['grade']?></span></a></li>
                  <li><a href="#">Echelon <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['echelon']?></span></a></li>
                  <li><a href="#">Grade Prochain <span class="pull-right badge bg-red"><?php echo $gp?></span></a></li>
                  <li><a href="#">Echelon Prochain <span class="pull-right badge bg-red"><?php echo $echp?></span></a></li>
                  <li><a href="#">Date prochain echelon (rythme normal) <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['date_echelon_normal']?></span></a></li>
                  <li><a href="#">Date prochain echelon (rythme moyen) <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['date_echelon_moyen']?></span></a></li>
                  <li><a href="#">Date prochain echelon (rythme rapide) <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['date_echelon_rapide']?></span></a></li>
                
                </ul>
              </div>
          </div><!-- /.widget-user -->
        </div><!-- /.col -->
        
    </div>
</section>

