<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Missions
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterMission'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Missions</h3>
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
              <th><?= $this->Paginator->sort('date_depart') ?></th>
              <th><?= $this->Paginator->sort('date_arrivee') ?></th>
              <th><?= $this->Paginator->sort('mode_transport') ?></th>
              <th><?= $this->Paginator->sort('nbr_nuit') ?></th>
              <th><?= $this->Paginator->sort('taux') ?></th>
              <th><?= $this->Paginator->sort('indemnite_kilometrique') ?></th>
              <th><?= $this->Paginator->sort('indemnite_appliquee') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= $this->Paginator->sort('total') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($missions as $mission): ?>
              <tr>
                <td><?= $this->Number->format($mission->id) ?></td>
                <td><?= h($mission->date_depart) ?></td>
                <td><?= h($mission->date_arrivee) ?></td>
                <td><?= h($mission->mode_transport) ?></td>
                <td><?= $this->Number->format($mission->nbr_nuit) ?></td>
                <td><?= $this->Number->format($mission->taux) ?></td>
                <td><?= $this->Number->format($mission->indemnite_kilometrique) ?></td>
                <td><?= $this->Number->format($mission->indemnite_appliquee) ?></td>
                <td><?= $this->Number->format($mission->etat) ?></td>
                <td><?= $this->Number->format($mission->total) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('modifier'), ['action' => 'modifierMission', $mission->id], ['class'=>'btn btn-warning btn-xs']) ?>
                 <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mission->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?> -->
                </td>
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
