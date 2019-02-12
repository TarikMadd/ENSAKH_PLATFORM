<section class="content">
 <?php 
        if($_SESSION['isdemande']=='no')
        { ?>
            <div class="alert alert-warning alert-dismissable">
                    
                    <h4><i class="icon fa fa-warning"></i> Pas de demandes à traiter !</h4>
                    
            </div>
        <?php 
        }
        else
        { ?>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Demandes abscences déposées :</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Nom et prénom </th>
                      <th>Grade</th>
                      <th>Duree d'absences</th>
                      <th>Action</th>
                    </tr>
                   <?php $i=1;
                   foreach ($_SESSION['demandes'] as $demande) 
                   { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                  <td><?php echo $demande['nom_fct']." ".$demande['prenom_fct'];?></td>
                  <td><?php echo $demande['grade'];?></td>
                  <td><?php echo $demande['duree_ab']." jour(s)";?></td>
                  <td><a href="traitementabs/<?php echo $demande['id'];?>"><span class="label label-primary">Traiter</span></a></td>
                  </tr>
         
                  <?php $i++;}
                   ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
  </div>
        <?php 
        } ?>

</section>