<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Vacataires
    <!--<div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>-->
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Vacataires</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <!--<div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>-->
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              
              <th><?= $this->Paginator->sort('somme') ?></th>
              <th><?= $this->Paginator->sort('nom_vacataire') ?></th>
              <th><?= $this->Paginator->sort('prenom_vacataire') ?></th>
           
              
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vacataires as $vacataire): ?>
              <tr>
                <td><?= $this->Number->format($vacataire->id) ?></td>
               
                <td><?= h($vacataire->somme) ?></td>
                <td><?= h($vacataire->nom_vacataire) ?></td>
                <td><?= h($vacataire->prenom_vacataire) ?></td>
            
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('afficher'), ['action' => 'viewvacatairre', $vacataire->id], ['class'=>'btn btn-info btn-xs']) ?>
                  
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
