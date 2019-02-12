<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Articles
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Articles</h3>
          <div class="box-tools">
            <form method="POST" action="articles/export">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" name="afficher" type="submit"><?= __('Rechercher')  ?></button>
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
              <th><?= $this->Paginator->sort('stock_categorie_id') ?></th>
              <th><?= $this->Paginator->sort('label_article') ?></th>
              <th><?= $this->Paginator->sort('quantite_min') ?></th>
              <th><?= $this->Paginator->sort('marque') ?></th>
              <th><?= $this->Paginator->sort('utilite') ?></th>
              <th><?= $this->Paginator->sort('quantite') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($articles as $article): ?>
              <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= $article->has('stock_category') ? $this->Html->link($article->stock_category->id, ['controller' => 'StockCategories', 'action' => 'view', $article->stock_category->id]) : '' ?></td>
                <td><?= h($article->label_article) ?></td>
                <td><?= $this->Number->format($article->quantite_min) ?></td>
                <td><?= h($article->marque) ?></td>
                <td><?= h($article->utilite) ?></td>
                <td><?= $this->Number->format($article->quantite) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $article->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
