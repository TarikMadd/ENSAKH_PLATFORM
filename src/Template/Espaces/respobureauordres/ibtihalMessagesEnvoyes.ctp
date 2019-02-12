<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Messages
    <div class="pull-right" ><?= $this->Html->link(__('Envoyer un nouveau message'), ['action' => 'ibtihalEnvoyer'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('liste des') ?> Messages Envoyés </h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('contenu') ?></th>
              <th><?= $this->Paginator->sort('user_id') ?></th>
              <th><?= $this->Paginator->sort('piecejointe') ?></th>


              <th><?= __('Vider') ?></th>
            </tr>
            <?php foreach ($h as $message): ?>
              <tr>
                <td><?= $this->Number->format($message->id) ?></td>
               

                <td><?= h($message->contenu) ?></td>
                <td><?= h($message->user_id) ?></td>
                <td><?= h($message->piecejointe) ?></td>

                <!--<td><?= $message->has('user') ? $this->Html->link($message->user->id, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></td> -->

                


                <td class="actions" style="white-space:nowrap">
                  
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'ibtihalDelete', $message->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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











