<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Evenement
    <div class="pull-right"><?= $this->Html->link(__('Ajouter'), ['action' => 'ajouterEvenements'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Evenements</h3>
          <div class="box-tools">
            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
             
              <th><?= $this->Paginator->sort('titre',array('label'=>"Titre")) ?></th>
              <th><?= $this->Paginator->sort('date',array('label'=>"Date")) ?></th>
              <th><?= $this->Paginator->sort('adresse',array('label'=>"Adresse")) ?></th>
              <th><?= $this->Paginator->sort('tele',array('label'=>"Téléphone")) ?></th>
              <th><?= $this->Paginator->sort('photo',array('label'=>"Photo")) ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($evenements as $evenement): ?>
              <tr>
                
                <td><?= h($evenement->titre) ?></td>
                <td><?= h($evenement->date) ?></td>
                <td><?= h($evenement->adresse) ?></td>
                <td><?= h($evenement->tele) ?></td>
                <td><?= h($evenement->photo) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Afficher'), ['action' => 'viewEvenements', $evenement->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Modifier'), ['action' => 'modifierEvenements', $evenement->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'supprimerEvenements', $evenement->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
