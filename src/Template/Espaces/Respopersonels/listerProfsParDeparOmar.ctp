<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Professeurs Departements
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'affecterProfDepar'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Professeurs Departements</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build();?>" method="POST">
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

              <th><?= $this->Paginator->sort('Num Somme') ?></th>
              <th><?= $this->Paginator->sort('Nom Prof') ?></th>
              <th><?= $this->Paginator->sort('Nom departement') ?></th>
              <th><?= $this->Paginator->sort('ID PROF') ?></th>
              <th><?= $this->Paginator->sort('ID DEPAR') ?></th>
               <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($VacatairesDepartements as $vacatairesDepartement): ?>
              <tr>

                <td><?= h($vacatairesDepartement->vacataires->somme)?></td>
                 <td><?= h($vacatairesDepartement->vacataires->vacataire_nom)?></td>
                  <td><?= h($vacatairesDepartement->departements->nom_departement)?></td>
                <td><?= $vacatairesDepartement->has('vacataires') ? $this->Html->link($vacatairesDepartement->vacataires->id, ['controller' => 'Vacataires','action' => 'view', $vacatairesDepartement->vacataires->id]) : '' ?></td>
                <td><?= $vacatairesDepartement->has('departements') ? $this->Html->link($vacatairesDepartement->departement->id, ['controller' => 'Departements', 'action' => 'view', $vacatairesDepartement->departement->id]) : '' ?></td>

                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $vacatairesDepartement->vacataires->id,$vacatairesDepartement->departements->id,$vacatairesDepartement->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vacatairesDepartement->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteProfDepar', $vacatairesDepartement->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
