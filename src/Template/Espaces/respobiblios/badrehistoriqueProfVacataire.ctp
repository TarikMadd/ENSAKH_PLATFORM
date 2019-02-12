<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users Books
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Users Books</h3>
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
              <th><?= $this->Paginator->sort('Professeurs') ?></th>
              <th><?= $this->Paginator->sort('titre') ?></th>
              <th><?= $this->Paginator->sort('numInventaire') ?></th>
              <th><?= $this->Paginator->sort('dateEmprunte') ?></th>
              <th><?= $this->Paginator->sort('date Retour') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php for ($i=0;$i<count($historiqueemprunte);$i++) { ?>
              <tr>
                <td><?= $historiqueemprunte[$i]['username'] ?></td>
                <td><?= $historiqueemprunte[$i]['titre'] ?></td>
                <td><?= $historiqueemprunte[$i]['numInventaire'] ?></td>
                <td><?= $historiqueemprunte[$i]['dateEmprunte'] ?></td>
                <td><?= $historiqueemprunte[$i]['dateRetour'] ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->