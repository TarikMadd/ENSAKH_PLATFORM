<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Parascolaire 
    <div class="pull-right"><?= $this->Html->link(__('Ajouter'), ['action' => 'ajouterActualiteClubs'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> actualités des clubs</h3>
          <div class="box-tools">
            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              
              <th><?= $this->Paginator->sort('titre',array('label'=>"Titre")) ?></th>
              <th><?= $this->Paginator->sort('date',array('label'=>"Date")) ?></th>
              <th><?= $this->Paginator->sort('id_club',array('label'=>"Club")) ?></th>
              <th><?= $this->Paginator->sort('image',array('label'=>"Photo")) ?></th>
              <th><?= $this->Paginator->sort('video',array('label'=>"URL de la vidéo ")) ?></th>
              <th><?= $this->Paginator->sort('fichier',array('label'=>"Fichier")) ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php
             if (is_array($actualiteclubs)) 
            foreach ($actualiteclubs as $actualiteclub): ?>
              <tr>
                
                <td><?= h($actualiteclub->titre) ?></td>
                <td><?= h($actualiteclub->date) ?></td>
                <td><?= h($actualiteclub->nom) ?></td>
                <td><?= h($actualiteclub->image) ?></td>
                <td><?= h($actualiteclub->video) ?></td>
                <td><?= h($actualiteclub->fichier) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Afficher'), ['action' => 'viewActualiteClubs', $actualiteclub->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Modifier'), ['action' => 'modifierActualiteClubs', $actualiteclub->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'supprimerActualiteClubs', $actualiteclub->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
