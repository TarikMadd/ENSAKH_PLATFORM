<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Actualiteclubs
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterActualiteClubs'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Actualiteclubs</h3>
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
              <th><?= $this->Paginator->sort('id_club') ?></th>
              <th><?= $this->Paginator->sort('image') ?></th>
              <th><?= $this->Paginator->sort('video') ?></th>
              <th><?= $this->Paginator->sort('fichier') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($actualiteclubs as $actualiteclub): ?>
              <tr>
                <td><?= $this->Number->format($actualiteclub->id) ?></td>
                <td><?= h($actualiteclub->titre) ?></td>
                <td><?= h($actualiteclub->date) ?></td>
                <td><?= $this->Number->format($actualiteclub->id_club) ?></td>
                <td><?= h($actualiteclub->image) ?></td>
                <td><?= h($actualiteclub->video) ?></td>
                <td><?= h($actualiteclub->fichier) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewActualiteClubs', $actualiteclub->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'modifierActualiteClubs', $actualiteclub->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'supprimerActualiteClubs', $actualiteclub->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
