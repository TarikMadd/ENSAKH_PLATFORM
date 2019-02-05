<section class="container-fluid">
 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Mes professeurs</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th style="width: 40px">Email</th>
                    </tr>
                    <?php $i=1;
  foreach($mesprofs as $value): ?>
   
	<tr>
	<td> <?php echo $i;?></td>
	<td> <?php echo $value['nom_prof'] ?></td>
	<td> <?php echo $value['prenom_prof'] ?></td>
	<td> <?php echo $value['email_prof'] ?></td>
	
		
	</tr>
	 <?php $i++;  ?>
		
<?php  endforeach;?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </section>






            
