<section class="container-fluid">
 <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Mes modules</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Module</th>
                      <th>Élément</th>
                      
                    </tr>
                    <?php $i=1;
  foreach($mesmodules as $value): ?>
   
	<tr>
	<td> <?php echo $i;?></td>
	<td> <?php echo $value['libile'] ?></td>
	<td> <?php echo $value['libele'] ?></td>	
	</tr>
	 <?php $i++;  ?>
		
<?php  endforeach;?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              </section>

