<section class="content">
 <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Les demandes de modifications des données envoyées par les professeurs permanents </h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Nom et prénom </th>
                      <th>Date d'envoie</th>
                      <th>Action</th>
                    </tr>
                   <?php $i=0;
                   foreach ($profpermabis as $profpermabi) 
                   { ?>
               		<tr>
               			<td><?php echo $i;?></td>
               		<td><?php echo $profpermabi['nom_prof']." ".$profpermabi['prenom_prof'];?></td>
               	
               		
                    <td><?php echo $profpermabi['date_envoi'];?></td>
               		<td><a href="validerDonnees/<?php echo $profpermabi['id'];?>"> <span class="btn btn-info btn-flat">Traiter</span></a></td>
                       
                       </tr>


                   	
                  <?php $i++;}
                   ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
	
</section>