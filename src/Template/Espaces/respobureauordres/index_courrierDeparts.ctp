<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Courrier Departs
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterCourrierDepart'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Courrier Departs</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
               
                <span class="input-group-btn">
                 <div class="pull-right"><?= $this->Html->link(__('Rechercher'), ['action' => 'trier'], ['class'=>'btn btn-success btn-xs']) ?></div>
        
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
              <th><?= $this->Paginator->sort('date_depart') ?></th>
              <th><?= $this->Paginator->sort('objet_depart') ?></th>
              <th><?= $this->Paginator->sort('service_depart') ?></th>
              <th><?= $this->Paginator->sort('expediteur_id') ?></th>
              <th><?= $this->Paginator->sort('type_courrier') ?></th>
              <th><?= $this->Paginator->sort('chemin_courier') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($courrierDeparts as $courrierDepart): ?>
              <tr>
                <td><?= $this->Number->format($courrierDepart->id) ?></td>
                <td><?= h($courrierDepart->date_depart) ?></td>
                <td><?= h($courrierDepart->objet_depart) ?></td>
                <td><?= h($courrierDepart->service_depart) ?></td>
                <td><?= $courrierDepart->has('expediteur') ? $this->Html->link($courrierDepart->expediteur->id, ['controller' => 'Expediteurs', 'action' => 'view', $courrierDepart->expediteur->id]) : '' ?></td>
                <td><?= h($courrierDepart->type_courrier) ?></td>
                <td><?= h($courrierDepart->chemin_courier) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewCourrierDepart', $courrierDepart->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'editCourrierDepart', $courrierDepart->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'supprimerCourrierDepart', $courrierDepart->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
