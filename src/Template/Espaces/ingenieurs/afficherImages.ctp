<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Images
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterImages'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Images</h3>
          <div class="box-tools">
           
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('lien') ?></th>
              <th><?= $this->Paginator->sort('commentaire') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($images as $image): ?>
              <tr>
                <td><?= $this->Number->format($image->id) ?></td>
                <td><?= h($image->lien) ?></td>
                <td><?= h($image->commentaire) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewImages', $image->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'modifierImages', $image->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'SupprimerImages', $image->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
