
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Articles
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add_articles'], ['class'=>'btn btn-success btn-xs']) ?></div>
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
            <form method="POST" action="export_articles">
              
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('label_article') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('utilite') ?></th>
            </tr>
            <?php foreach ($articles as $article): ?>
             <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= h($article->label_article) ?></td>
                <td><?= h($article->quantite) ?></td>
                <td><?= h($article->utilite) ?></td>
				
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->