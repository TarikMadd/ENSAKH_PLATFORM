
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Magasins
    <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'add_magasins'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Listes des') ?> Magasins</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('nom_magasin') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($magasins as $magasin): ?>
              <tr>
                <td><?= $this->Number->format($magasin->id) ?></td>
                <td><?= h($magasin->nom_magasin) ?></td>
   
                <td class="actions" style="white-space:nowrap">
                 <?= $this->Html->link(__('Afficher'), ['action' => 'view_magasins', $magasin->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Modifier'), ['action' => 'edit_magasins', $magasin->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete_magasins', $magasin->id], ['confirm' => __('Etes vous sûr de supprimer le magasin?'), 'class'=>'btn btn-danger btn-xs']) ?>
				     
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
