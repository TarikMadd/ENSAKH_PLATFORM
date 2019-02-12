<section class="content">
 <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Les demandes de modifications des données envoyées par les professeurs vacataires </h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Nom et prénom </th>
                      <th>Nombre d'heures</th>
                      <th>Date d'envoie</th>
                      <th>Action</th>
                    </tr>
                   <?php $i=0;
                   foreach ($profvacbis as $profvacbi) 
                   { ?>
               		<tr>
               			<td><?php echo $i;?></td>
               		<td><?php echo $profvacbi['nom_vacataire']." ".$profvacbi['prenom_vacataire'];?></td>
               		<td><?php echo $profvacbi['nb_heures'];?></td>
               		
                    <td><?php echo $profvacbi['date_envoi'];?></td>
               		<td><a href="validerDonneesVac/<?php echo $profvacbi['id'];?>"> <span class="btn btn-info btn-flat">Traiter</span></a></td>
                       
                       </tr>


                   	
                  <?php $i++;}
                   ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
	
</section>