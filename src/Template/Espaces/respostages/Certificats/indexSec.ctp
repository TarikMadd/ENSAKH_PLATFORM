
<section class="content-header">
  <h1>
    Certificats
    <div class="pull-right"><?= $this->Html->link(__(''), ['action' => 'addCertificats'], ['class'=>'btn fa fa-plus btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Certificats</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"> Rechercher </button>
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
              <th><?= $this->Paginator->sort('type') ?></th>
              <th><?= $this->Paginator->sort('nombre_max') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
           <?php for($i=0;$i<count($certificats);$i++): ?>
              <tr>
                <td><?= h($certificats[$i]['id']) ?></td>
                <td><?= h($certificats[$i]['type']) ?></td>
                <td> <?= h($certificats[$i]['nombre_max']) ?> </td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('View'), ['action' => 'viewCertificats', $certificats[$i]['id']], ['class'=>'btn btn-info btn-xs'] )?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'editCertificats', $certificats[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteCertificats', $certificats[$i]['id']], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endfor; ?>
          </table>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
