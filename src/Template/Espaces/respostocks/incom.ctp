<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Commandes
    <div class="pull-right"><?= $this->Html->link(__('Nouveau'), ['action' => 'addCA'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Listes des') ?> Commandes</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
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
              <th><?= $this->Paginator->sort('fournisseur_id') ?></th>
              <th><?= $this->Paginator->sort('cree') ?></th>
              <th><?= $this->Paginator->sort('article_id') ?></th>
              <th><?= $this->Paginator->sort('nbr_article') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($commandes as $commande): ?>
              <tr>
                <td><?= $this->Number->format($commande->id) ?></td>
                <td><?= $commande->has('fournisseur') ? $this->Html->link($commande->fournisseur->id, ['controller' => 'Respostocks', 'action' => 'view_fournisseurs', $commande->fournisseur->id]) : '' ?></td>
                <td><?= h($commande->cree) ?></td>
                <td><?= $commande->has('article') ? $this->Html->link($commande->article->id, ['controller' => 'Respostocks', 'action' => 'view_articles', $commande->article->id]) : '' ?></td>
                <td><?= $this->Number->format($commande->nbr_article) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Afficher'), ['action' => 'view_commandes', $commande->id], ['class'=>'btn btn-info btn-xs']) ?>
	
                  <?= $this->Html->link(__('Modifier'), ['action' => 'edit_commandes', $commande->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete_commandes', $commande->id], ['confirm' => __('Etes vous sûr de supprimer la commande?'), 'class'=>'btn btn-danger btn-xs']) ?>
				     <?= $this->Html->link(__('Devis'), ['action' => 'com', $commande->id], ['class'=>'btn btn-success btn-xs']) ?>
				   <?= $this->Html->link(__('Liste '), ['action' => 'liste', $commande->id], ['class'=>'btn btn-default btn-xs']) ?>
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
