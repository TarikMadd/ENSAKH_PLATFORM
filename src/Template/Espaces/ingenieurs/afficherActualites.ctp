<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Actualites
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterActualites'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Actualites</h3>
          <div class="box-tools">
            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('titre') ?></th>
              <th><?= $this->Paginator->sort('date') ?></th>
              <th><?= $this->Paginator->sort('photo') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($actualites as $actualite): ?>
              <tr>
                <td><?= $this->Number->format($actualite->id) ?></td>
                <td><?= h($actualite->titre) ?></td>
                <td><?= h($actualite->date) ?></td>
                <td><?= h($actualite->photo) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewActualites', $actualite->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'modifierActualites', $actualite->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'supprimerActualites', $actualite->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
