




<div class="row">
            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                  <div class="widget-user-image">
                  <td class="img-circle">
                  	<?php 
  foreach($id as $value): ?>
   
	<tr>
	
	<td ><?php echo $this->Html->image($value['photo'],['alt' =>'CakePHP']); ?></td>
	</tr>
	
		
<?php  endforeach;?>
                  </td>
                    
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username"><?=  $id[0]['nom_fr'] ?></h3>
                  <h5 class="widget-user-desc">
                  	  
	
	<td ><?= $role ?></td>
	
                  </h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                      <li><?php 
  foreach($id as $value): ?>
   
  <tr>
  
  <td ><?php echo $value['nom_fr'] ?></td>
  </tr>
  
    
<?php  endforeach;?> &nbsp;
<?php 
  foreach($id as $value): ?>
   
  <tr>
  
  <td ><?php echo $value['prenom_fr'] ?></td>
  </tr>
  
    
<?php  endforeach;?></li>
                        <li>
                        <?php 
  foreach($id as $value): ?>
   
  <tr>
  
  <td > CNE: <?php echo $value['cne'] ?></td>
  </tr>
  
    
<?php  endforeach;?>
                          
                        </li>
                          <li>************</li>
                            <li>**********</li>
                    
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
</div>