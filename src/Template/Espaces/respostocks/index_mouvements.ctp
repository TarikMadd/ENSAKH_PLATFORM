<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mouvements
    <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'add_mouvements'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List des') ?> Mouvements</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('date_mouvement') ?></th>
              <th><?= $this->Paginator->sort('reference_entree') ?></th>
              <th><?= $this->Paginator->sort('reference_sortie') ?></th>
              <th><?= $this->Paginator->sort('quantite_entree') ?></th>
              <th><?= $this->Paginator->sort('quantite_sortie') ?></th>
              <th><?= $this->Paginator->sort('service') ?></th>
              <th><?= $this->Paginator->sort('magasin_id') ?></th>
			  <th><?= $this->Paginator->sort('article_id') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mouvements as $mouvement): ?>
              <tr>
                <td><?= h($mouvement->date_mouvement) ?></td>
                <td><?= h($mouvement->reference_entree) ?></td>
                <td><?= h($mouvement->reference_sortie) ?></td>
                <td><?= $this->Number->format($mouvement->quantite_entree) ?></td>
                <td><?= $this->Number->format($mouvement->quantite_sortie) ?></td>
                <td><?= h($mouvement->service) ?></td>
                <td><?= $mouvement->has('magasin') ? $this->Html->link($mouvement->magasin->nom_magasin, ['controller' => 'Respostocks', 'action' => 'view_magasins', $mouvement->magasin->nom_magasin]) : '' ?></td>
				<td><?= $mouvement->has('article') ? $this->Html->link($mouvement->article->label_article, ['controller' => 'Respostocks', 'action' => 'view_articles', $mouvement->article_id]) : '' ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Afficher'), ['action' => 'view_mouvements', $mouvement->id], ['class'=>'btn btn-info btn-xs']) ?>
				  <?php if($mouvement->quantite_entree<$mouvement->quantite_sortie){ ?>
                  <?= $this->Html->link(__('Modifier'), ['action' => 'edit_mouvements', $mouvement->id], ['class'=>'btn btn-warning btn-xs']) ?>
				  <?php } ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete_mouvements', $mouvement->id], ['confirm' => __('Confirmer la suppression de ce mouvement?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
