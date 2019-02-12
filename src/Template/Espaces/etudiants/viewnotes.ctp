<section class="content">
	<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">MES NOTES</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>#</th>
                      <th>Module</th>
                      <th>Element de Module</th>
                      <th>Note</th>
                      <th>Décision</th>
                    </tr>
                    <?php 
                    for ($i=0; $i <sizeof($_SESSION['notes']) ; $i++) 
                    { ?>
                    	<tr>
	                    	<td><?php echo $i+1; ?></td>
	                    	<td><?php echo $_SESSION['notes'][$i]['l']?></td>
	                    	<td><?php echo $_SESSION['notes'][$i]['libile']?></td>
	                    	<td><?php if($_SESSION['autori'] == 'no') echo "<span class=\"label label-danger\">Non Disponible</span>"; else echo "<span class=\"badge bg-grey\">".$_SESSION['notes'][$i]['note']."</span>";?></td>
	                    	<td><?php if($_SESSION['dec'] == 'no') 
	                    			echo "<span class=\"label label-danger\">Non Disponible</span>"; else
	                    			{
	                    				if($_SESSION['notes'][$i]['id'] == 1 || $_SESSION['notes'][$i]['id']==2)
	                    				{
	                    					if($_SESSION['notes'][$i]['note']>=10)
	                    						echo "<span class=\"label label-success\">VALIDE</span>";
	                    					else if ($_SESSION['notes'][$i]['note']<10 && $_SESSION['notes'][$i]['note']>=7)
	                    						echo "<span class=\"label label-warning\">NON VALIDE</span>";
	                    					else
	                    						echo "<span class=\"label label-danger\">AJOURNE</span>";
	                    				}
	                    				else
	                    				{
	                    					if($_SESSION['notes'][$i]['note']>=12)
	                    						echo "<span class=\"label label-success\">VALIDE</span>";
	                    					else if ($_SESSION['notes'][$i]['note']<12 && $_SESSION['notes'][$i]['note']>=8)
	                    						echo "<span class=\"label label-warning\">NON VALIDE</span>";
	                    					else
	                    						echo "<span class=\"label label-danger\">AJOURNE</span>";
	                    				}
	                    			} 
	                    			?></td>
                    	</tr>
                   <?php }
                    ?>
                    
                  </table>
                </div>
                </div>
</section>