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
                <th scope="col"><?= $this->Paginator->sort('date_depart') ?></th>
        
                
            </tr>
        </thead>
        <tbody>
    
            <?php foreach ($courrierDeparts as $courrierDeparts): ?>
            <tr>
      
      
       <td> <?php echo $courrierDeparts['id']; ?> </td>
             <td> <?php echo $courrierDeparts['date_depart'];?> </td>
             
      
      
      
      
      
      
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





