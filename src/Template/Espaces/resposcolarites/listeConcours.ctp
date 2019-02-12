<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Concours
    
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List des') ?> Concours</h3>
         
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('niveaus') ?></th>
              <th><?= $this->Paginator->sort('filiere') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= $this->Paginator->sort('date debut') ?></th>
              <th><?= $this->Paginator->sort('date fin') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($concours as $concour): ?>
              <tr>
                <?php if($this->Number->format($concour->etat) == 0){
                  $etta = 'fermé';
                }else{
                  $etta = 'lancé';
                } ?>
                <td><?= $this->Number->format($concour->id) ?></td>
                <td><?= $concour->has('niveau') ? $this->Html->link($concour->niveau->libile, ['controller' => 'Niveaus', 'action' => 'view', $concour->niveau->libile]) : '' ?></td>
                <td><?= $concour->has('filiere') ? $this->Html->link($concour->filiere->libile, ['controller' => 'Filieres', 'action' => 'view', $concour->filiere->libile]) : '' ?></td>
                <td><?= $etta ?></td>
                <td><?= h($concour->date_debut) ?></td>
                <td><?= h($concour->date_fin) ?></td>
                <td class="actions" style="white-space:nowrap">
                 
                  <?php 
                  if ($concour->etat == 0) {
                      echo $this->Html->link(__('Lancer'), ['action' => 'lancerConcours', $concour->id], ['class'=>'btn btn-success btn-xs']);
                      echo $this->Form->postLink(__('Fermer'), ['action' => 'fermer', $concour->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-danger btn-xs', 'style'=> 'pointer-events: none; cursor: default; background-color: #555; margin-left:5px;']); 
                  }else{
                      echo $this->Html->link(__('Lancer'), ['action' => 'lancerConcours', $concour->id], ['class'=>'btn btn-success btn-xs', 'style'=> 'pointer-events: none; cursor: default; background-color: #555; margin-right:5px;']);
                      echo $this->Form->postLink(__('Fermer'), ['action' => 'fermer', $concour->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-danger btn-xs']);
                     }

                  ?>
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
