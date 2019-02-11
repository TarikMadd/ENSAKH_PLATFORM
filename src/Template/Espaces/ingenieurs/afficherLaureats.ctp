<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Laureats
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterLaureats'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Laureats</h3>
          <div class="box-tools">

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('annee') ?></th>
              <th><?= $this->Paginator->sort('nombresTravailles') ?></th>
              <th><?= $this->Paginator->sort('nombresNonTravailles') ?></th>
              <th><?= $this->Paginator->sort('filieres') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($laureats as $laureat): ?>
              <tr>
                <td><?= $this->Number->format($laureat->id) ?></td>
                <td><?= h($laureat->annee) ?></td>
                <td><?= $this->Number->format($laureat->nombresTravailles) ?></td>
                <td><?= $this->Number->format($laureat->nombresNonTravailles) ?></td>
                <td><?= h($laureat->filieres) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Afficher'), ['action' => 'viewLaureats', $laureat->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Modifier'), ['action' => 'modifierLaureats', $laureat->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'supprimerLaureats', $laureat->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
<style>
.button {
    border-radius: 10px;
    background-color: red;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 10px;
    padding: 10px;
    width: 140px;
    cursor: pointer;
    margin: 10px;
}
</style>
<?php echo '<h3>  Tapper une annee et vous auriez les informations sur les laureats de cette annee :  </h3>
<form action="liste2" method="post">
<input type="text" name="annee" >
<button type="submit" class="button" name="button">valider</button>
</form>


';?>
<!-- /.content -->
