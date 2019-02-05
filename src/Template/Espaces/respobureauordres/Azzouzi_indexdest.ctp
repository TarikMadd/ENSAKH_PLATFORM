<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Expediteurs
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'Azzouzi_ajouterdestinataire'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Destinataire</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
			  
              
                <span class="input-group-btn">
				
				
               <div class="pull-right"><?= $this->Html->link(__('Rechercher'), ['action' => 'Azzouzi_trierdest'], ['class'=>'btn btn-success btn-xs']) ?></div>
				
				
				
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('nomComplet_destinataire') ?></th>
              <th><?= $this->Paginator->sort('adresse_destinataire') ?></th>
              <th><?= $this->Paginator->sort('email_destinataire') ?></th>
              <th><?= $this->Paginator->sort('telephone_destinataire') ?></th>
              <th><?= $this->Paginator->sort('service_destinataire') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
           
                 <?php foreach ($Destinataires as $Destinataires): ?>
            <tr>
			
			
			 <td> <?php echo $Destinataires['id']; ?> </td>
             <td> <?php echo $Destinataires['nomComplet_destinataire'];?> </td>
             <td><?php echo $Destinataires['adresse_destinataire']; ?></td>
             <td><?php echo $Destinataires['email_destinataire'];?></td>
             <td><?php echo $Destinataires['telephone_destinataire']; ?></td>
             <td><?php echo $Destinataires['service_destinataire']; ?></td>
                <td class="actions" style="white-space:nowrap">
             
                  <?= $this->Html->link(__('Edit'), ['action' => 'Azzouzi_editdest', $Destinataires->id], ['class'=>'btn btn-warning btn-xs']) ?>
            
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'Azzouzi_supprimerdest', $Destinataires->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->

