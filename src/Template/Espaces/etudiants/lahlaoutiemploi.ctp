
<?php 
  foreach($emploi as $value): ?>
   
	<tr>
	
	<td  ><?php echo $this->Html->image($value['photo_emploi'],['alt' =>'CakePHP']); ?></td>
	</tr>
	
		
<?php  endforeach;?>
