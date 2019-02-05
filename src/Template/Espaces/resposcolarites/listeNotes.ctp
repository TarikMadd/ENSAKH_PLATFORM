<?php 
if($_SESSION['tous'] != 0)
{ ?>
  <section class="content-header">
          <h4 style="margin-left: 12px;">
            <i class="fa fa-fw fa-file-text"></i>Liste des notes
          </h4>
          <ol class="breadcrumb" style="margin-right: 20px;">
          
            <li><?php echo $_SESSION['classe'];?></li>
            <li><?php echo $_SESSION['lib_sem'];?></li>
            <li><?php echo $_SESSION['nom_mod'];?></li>
            <li><?php if($_SESSION['sess']==1) echo "Session normale";else echo "Session rattrapage";?></li>
          </ol>
  </section>
<?php
if($_SESSION['is_note'] == 'yes')
{ ?>
<section class="content">

            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
                  <li><a href="#resultats" data-toggle="tab">Résultats</a></li>
                  
                </ul>

                <div class="tab-content no-padding">
                  
                  <div class="chart tab-pane active" id="notes" style="position: relative;">
                    <div class="box-body">
                  <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="110">
                  <col width="110">
                  <?php
                   for ($i=1; $i <= $_SESSION['nbr_ele'][0]['n']; $i++) 
                          { ?>
                             <col width="100">
                          <?php } 
                  ?>
                  <?php 
                    if($_SESSION['nbr_ele'][0]['n']>1)
                    {
                      echo "<col width=\"100\">";
                    }
                  ?>
                  <thead>
                      <tr>
                        <th colspan="4" style="text-align: center">ETUDIANT</th>
                        <th colspan="<?php echo $_SESSION['nbr_ele'][0]['n'];?>" style="text-align: center">NOTE</th>
                        <?php 
                          if($_SESSION['nbr_ele'][0]['n']>1)
                          {
                            echo "<th rowspan=\"2\" style=\"text-align: center\">RESULTAT</th>";
                          }
                        ?>
                      </tr>
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        <?php
                          for ($i=0; $i < $_SESSION['nbr_ele'][0]['n']; $i++) 
                          { ?>
                             <th style="text-align: center"><?php echo $_SESSION['ele'][$i]['libile'];?></th>
                          <?php } 
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $j=0; $kj=0;

                      foreach ($_SESSION['etudiants'] as $etudiant) 
                      { if($kj < 2)
                      { ?>
                          <tr>
                              <td><?php echo $j+1?></td>
                              <td><?php echo $etudiant['cne']?></td>
                              <td><?php echo $etudiant['nom_fr']?></td>
                              <td><?php echo $etudiant['prenom_fr']?></td>
                              <?php $somme=0; for ($i=0; $i < $_SESSION['nbr_ele'][0]['n']; $i++)
                              { ?>
                                  <td><?php if($_SESSION['sess']==1) {
                                          $somme += $_SESSION['notes'][$i][$j];
                                          echo $_SESSION['notes'][$i][$j];}
                                      else {
                                          $somme += $_SESSION['notes'][$i][$j];
                                          echo $_SESSION['notes'][$i][$j];}?></td>
                              <?php }?>
                              <?php
                              if($_SESSION['nbr_ele'][0]['n']>1)
                              {?>
                                  <td><?php if($_SESSION['sess']==1) echo $somme/$_SESSION['nbr_ele'][0]['n']; else
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($somme/$_SESSION['nbr_ele'][0]['n']>10)
                                                  echo 10;
                                          }
                                          else
                                          {
                                              if($somme/$_SESSION['nbr_ele'][0]['n']>12)
                                                  echo 12;
                                          }
                                      }?></td>
                              <?php }
                              ?>

                          </tr>
                     <?php }?>

                      <?php $j++; $kj++;}?>
                      
                    </tbody>
                  </table>
                </div>
                  </div>
                  <div class="chart tab-pane" id="resultats" style="position: relative;">
                  <div class="box-body">
                  <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="110">
                  <col width="110">
                  <?php
                   for ($i=1; $i <= $_SESSION['nbr_ele'][0]['n']; $i++) 
                          { ?>
                             <col width="100">
                          <?php } 
                  ?>
                  <?php 
                    if($_SESSION['nbr_ele'][0]['n']>1)
                    {
                      echo "<col width=\"100\">";
                    }
                  ?>
                  <thead>
                      <tr>
                        <th colspan="4" style="text-align: center">ETUDIANT</th>
                        <th colspan="<?php echo $_SESSION['nbr_ele'][0]['n'];?>" style="text-align: center">RESULTAT</th>
                        <?php 
                          if($_SESSION['nbr_ele'][0]['n']>1)
                          {
                            echo "<th rowspan=\"2\" style=\"text-align: center\">RESULTAT</th>";
                          }
                        ?>
                      </tr>
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        <?php
                          for ($i=0; $i < $_SESSION['nbr_ele'][0]['n']; $i++)
                          { ?>
                             <th style="text-align: center"><?php echo $_SESSION['ele'][$i]['libile'];?></th>
                          <?php } 
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $j=0; $u=0;
                      foreach ($_SESSION['etudiants'] as $etudiant) 
                      { if($u<2)
                      { ?>
                          <tr>
                              <td><?php echo $j+1?></td>
                              <td><?php echo $etudiant['cne']?></td>
                              <td><?php echo $etudiant['nom_fr']?></td>
                              <td><?php echo $etudiant['prenom_fr']?></td>
                              <?php for ($i=0; $i < $_SESSION['nbr_ele'][0]['n']; $i++)
                              { ?>
                                  <td>
                                      <?php
                                      if($_SESSION['sess']==1)
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($_SESSION['notes'][$i][$j]>=10)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                          else
                                          {
                                              if($_SESSION['notes'][$i][$j]>=12)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                      }
                                      else
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($_SESSION['notes'][$i][$j]>=10)
                                                  echo "Validé";

                                              else if($_SESSION['notes'][$i][$j]<10 && $_SESSION['notes'][$i][$j]>=7 )
                                                  echo "Non validé";
                                              else
                                                  echo "Ajourné";
                                          }
                                          else
                                          {
                                              if($_SESSION['notes'][$i][$j]>=12)
                                                  echo "Validé";

                                              else if($_SESSION['notes'][$i][$j]<12 && $_SESSION['notes'][$i][$j]>=8 )
                                                  echo "Non validé";
                                              else
                                                  echo "Ajourné";
                                          }
                                      } ?>
                                  </td>
                              <?php }
                              if($_SESSION['nbr_ele'][0]['n']>1){
                                  ?>
                                  <td><?php
                                      if($_SESSION['sess']==1)
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($somme/$_SESSION['nbr_ele'][0]['n']>=10)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                          else
                                          {
                                              if($somme/$_SESSION['nbr_ele'][0]['n']>=12)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                      }
                                      else
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($somme/$_SESSION['nbr_ele'][0]['n']>=10)
                                                  echo "Validé";

                                              else if($somme/$_SESSION['nbr_ele'][0]['n']<10 && $somme/$_SESSION['nbr_ele'][0]['n']>=7 )
                                                  echo "Non validé";
                                              else
                                                  echo "Ajourné";
                                          }
                                          else
                                          {
                                              if($somme/$_SESSION['nbr_ele'][0]['n']>=12)
                                                  echo "Validé";

                                              else if($somme/$_SESSION['nbr_ele'][0]['n']<12 && $somme/$_SESSION['nbr_ele'][0]['n']>=8 )
                                                  echo "Non validé";
                                              else
                                                  echo "Ajourné";
                                          }
                                      }
                                      ?>
                                  </td> <?php } ?>
                          </tr>
                      <?php }?>

                      <?php $j++; }?>
                      
                    </tbody>
                    
                  </table>
                </div>
                  </div>

                </div>

              </div>

             <div class="pull-right">
             <a href="imprimerlistenote/<?php echo $_SESSION['id_module'];?>"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-print"></i>Imprimer la liste</button></a>
                
              </div>
               <div class="pull-left">
             <a href="affichagenote"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Retour</button></a>
                
              </div>
             
              </section>
<?php }
else 
{ ?>
<section class="content">
     <div class="col-md-12">
              
                <!-- /.box-header -->
                <div class="box-body">
                 
                  <div class="alert alert-warning alert-dismissable" style="margin-left: -13px;">
                    
                    <h4><i class="icon fa fa-warning"></i>Ce module n'est pas encore traité !</h4>
                    
                  </div>
                  
               
              </div><!-- /.box -->
            </div>
             <div class="pull-left" style="margin-left: 15px;">
             <a href="affichagenote"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Retour</button></a>
                
              </div>
    </section>
<?php } 
?>  
<?php }
else if($_SESSION['tous'] == 0)
{ ?>
  <section class="content-header">
            <h4 style="margin-left: 12px;">
              <i class="fa fa-fw fa-file-text"></i>Liste des notes
            </h4>
            <ol class="breadcrumb" style="margin-right: 20px;">
            
              <li><?php echo $_SESSION['classe'];?></li>
              <li><?php echo $_SESSION['lib_sem'];?></li>
              <li><?php if($_SESSION['sess']==1) echo "Session normale";else echo "Session rattrapage";?></li>
            </ol>
            
  </section>
<?php 
if($_SESSION['is_note'] == 'yes')
{ ?>
<section class="content">
<?php if($_SESSION['is']=="yes")
{ ?>
<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>  <i class="icon fa fa-check"></i> L'action a été effectuée avec succès.</h4>
                    
                  </div>
<?php }
else if($_SESSION['is']=="no")
{ ?>
<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i>Vous avez déjà effectué cette action.</h4>
                   
                  </div>
<?php }
?>
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#notes" data-toggle="tab">Notes</a></li>
                  <li><a href="#resultats" data-toggle="tab">Résultats</a></li>
                  
                </ul>
                <div class="tab-content no-padding">
                  
                  <div class="chart tab-pane active" id="notes" style="position: relative;">
                    <div class="box-body">
                  <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="110">
                  <col width="110">
                  <?php
                   for ($i=1; $i <= $_SESSION['nbr_mod']; $i++) 
                          { ?>
                             <col width="100">
                          <?php } 
                  ?>
                  
                  <thead>
                      <tr>
                        <th colspan="4" style="text-align: center">ETUDIANT</th>
                        <th colspan="<?php echo $_SESSION['nbr_mod'];?>" style="text-align: center">NOTE</th>
                      </tr>
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        <?php
                          for ($i=0; $i < $_SESSION['nbr_mod']; $i++) 
                          { ?>
                             <th style="text-align: center"><?php echo $_SESSION['modules'][$i]['libile'];?></th>
                          <?php } 
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $j=0; $u=0;
                      foreach ($_SESSION['etudiants'] as $etudiant) 
                      { if($u<2)
                      { ?>
                          <tr>
                              <td><?php echo $j+1?></td>
                              <td><?php echo $etudiant['cne']?></td>
                              <td><?php echo $etudiant['nom_fr']?></td>
                              <td><?php echo $etudiant['prenom_fr']?></td>
                              <?php for ($i=0; $i < $_SESSION['nbr_mod']; $i++)
                              { ?>
                                  <td><?php if($_SESSION['sess']==1)
                                      {
                                          echo $_SESSION['notes'][$i][$j];
                                      }
                                      else if($_SESSION['sess']==2)
                                      {
                                          echo $_SESSION['notes'][$i][$j];

                                      }
                                      ?></td>
                              <?php }?>
                          </tr>
                     <?php }?>

                      <?php $j++; $u++; }?>
                      
                    </tbody>
                  </table>
                </div>
                
                  </div>
                  <div class="chart tab-pane" id="resultats" style="position: relative;">
                  <div class="box-body">
                  <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="110">
                  <col width="110">
                  <?php
                   for ($i=1; $i <= $_SESSION['nbr_mod']; $i++) 
                          { ?>
                             <col width="100">
                          <?php } 
                  ?>
                  <thead>
                      <tr>
                        <th colspan="4" style="text-align: center">ETUDIANT</th>
                        <th colspan="<?php echo $_SESSION['nbr_mod'];?>" style="text-align: center">RESULTAT</th>
                      </tr>
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        <?php
                          for ($i=0; $i < $_SESSION['nbr_mod']; $i++)
                          { ?>
                             <th style="text-align: center"><?php echo $_SESSION['modules'][$i]['libile'];?></th>
                          <?php } 
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $j=0; $u=0;
                      foreach ($_SESSION['etudiants'] as $etudiant) 
                      { if($u<2)
                      { ?>
                          <tr>
                              <td><?php echo $j+1?></td>
                              <td><?php echo $etudiant['cne']?></td>
                              <td><?php echo $etudiant['nom_fr']?></td>
                              <td><?php echo $etudiant['prenom_fr']?></td>
                              <?php for ($i=0; $i < $_SESSION['nbr_mod']; $i++)
                              { ?>
                                  <td>
                                      <?php
                                      if($_SESSION['sess']==1)
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($_SESSION['notes'][$i][$j]>=10)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                          else
                                          {
                                              if($_SESSION['notes'][$i][$j]>=12)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                      }
                                      else
                                      {
                                          if($_SESSION['id_groupe'] ==1 || $_SESSION['id_groupe']==2)
                                          {
                                              if($_SESSION['notes'][$i][$j]>=10)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                          else
                                          {
                                              if($_SESSION['notes'][$i][$j]>=12)
                                                  echo "Validé";

                                              else
                                                  echo "Rattrapage";
                                          }
                                      }?>
                                  </td>
                              <?php }?>
                          </tr>
                    <?php  }?>

                      <?php $j++; $u++; }?>
                      
                    </tbody>
                  </table>
                  
                </div>
                  </div>

                </div>

              </div>
              <div class="pull-right">
              <?php
                echo $this->form->create();
          ?>
             <button class="btn btn-block btn-success" name="publier"><i class="fa fa-fw fa-share"></i>Publier les résultats</button>
                
              </div>
              <?php
              echo $this->form->end();
            ?>
              <div class="pull-right" style="margin-right: 10px;">
             <a href="imprimerreleve"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-print"></i>Imprimer la liste</button></a>
                
              </div>
               <div class="pull-left">
             <a href="affichagenote"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Retour</button></a>
                
              </div>
</section>
<?php }
else{ ?>
<section class="content">
     <div class="col-md-12">
              
                <!-- /.box-header -->
                <div class="box-body">
                 
                  <div class="alert alert-warning alert-dismissable" style="margin-left: -13px;">
                    
                    <h4><i class="icon fa fa-warning"></i>Des modules ne sont pas encore traités !</h4>
                    
                  </div>
                  
               
              </div><!-- /.box -->
            </div>
             <div class="pull-left" style="margin-left: 15px;">
             <a href="affichagenote"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Retour</button></a>
                
              </div>
    </section>
 <?php } ?> 
<?php }
?>