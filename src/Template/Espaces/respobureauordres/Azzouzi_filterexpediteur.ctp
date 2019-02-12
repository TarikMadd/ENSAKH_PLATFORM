<?php
/**
  * @var \App\View\AppView $this
  */
?>

 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Result of') ?> Search</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
	
                <span class="input-group-btn">
		
				
                </span>
              </div>
            </form>
          </div>
        </div>
 
 
 <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>

          
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NomCompletExpediteur') ?></th>
				<th><?= $this->Paginator->sort('adresse_expediteur') ?></th>
              <th><?= $this->Paginator->sort('email_expediteur') ?></th>
              <th><?= $this->Paginator->sort('telephone_expediteur') ?></th>
              <th><?= $this->Paginator->sort('service_expediteur') ?></th>
                
            </tr>
        </thead>
        <tbody>
		
            <?php foreach ($expediteurs as $expediteurs): ?>
            <tr>
			
			
			 <td> <?php echo $expediteurs['id']; ?> </td>
             <td> <?php echo $expediteurs['nomComplet_expediteur'];?> </td>
             <td><?php echo $expediteurs['adresse_expediteur']; ?></td>
             <td><?php echo $expediteurs['email_expediteur'];?></td>
             <td><?php echo $expediteurs['telephone_expediteur']; ?></td>
             <td><?php echo $expediteurs['service_expediteur']; ?></td>
			
			
			
			
			
			
			<?php /*
			
                <td><?= $this->Number->format($expediteurs->id) ?></td>
                <td><?= h($expediteurs->nomComplet_expediteur) ?></td>
                <td><?= h($expediteurs->adresse_expediteur) ?></td>
                <td><?= h($expediteurs->email_expediteur) ?></td>
                <td><?= $this->Number->format($expediteurs->telephone_expediteur) ?></td>
                <td><?= h($expediteurs->service_expediteur) ?></td>
              */ ?>
			  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	
 
</div>
</section>





