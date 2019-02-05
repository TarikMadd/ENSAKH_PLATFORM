<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Vacations
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Vacations</h3>
          <div class="box-tools">

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('mois') ?></th>
              <th><?= $this->Paginator->sort('annee') ?></th>
              <th><?= $this->Paginator->sort('nbHeure') ?></th>
              <th><?= $this->Paginator->sort('dateInsertion') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>

              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vacations as $vacation): ?>
              <tr>
                <td><?= $this->Number->format($vacation->id) ?></td>
                <td><?= $this->Number->format($vacation->mois) ?></td>
                <td><?= h($vacation->annee) ?></td>
                <td><?= $this->Number->format($vacation->nbHeure) ?></td>
                <td><?= h($vacation->dateInsertion) ?></td>
                <td><?= h($vacation->etat) ?></td>
                 <?php

                 if ($vacation->etat=="non validé") {
                   
                 ?>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewVacation', $vacation->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'modifierVacation', $vacation->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'supprimerVacation', $vacation->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
                <?php

                  }
                  else 
                   echo "<td> </td>";
                 ?>

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
