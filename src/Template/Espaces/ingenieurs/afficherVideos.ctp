<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Vidéos
    <div class="pull-right"><?= $this->Html->link(__('Ajouter'), ['action' => 'ajouterVideos'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Vidéos</h3>
          <div class="box-tools">
           
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              
              <th><?= $this->Paginator->sort('lien',array('label'=>"URL de la vidéo")) ?></th>
              <th><?= $this->Paginator->sort('commentaire',array('label'=>"Commentaire")) ?></th>
              
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($videos as $video): ?>
              <tr>
                
                <td><?= h($video->lien) ?></td>
                <td><?= h($video->commentaire) ?></td>
               
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Afficher'), ['action' => 'viewVideos', $video->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Modifier'), ['action' => 'modifierVideos', $video->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'supprimerVideos', $video->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
