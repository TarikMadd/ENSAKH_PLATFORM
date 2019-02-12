<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Missions
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterMissionProf'], ['class'=>'btn btn-success btn-xs']) ?>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Missions</h3>
          <div class="box-tools">
            <form name="Recherche" action="afficherProf" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <select name="search" class="form-control" >
                  <?php foreach ($profpermanents as $prof): ?>
                      <option value=<?php echo $prof['id']?>> <?php echo $prof['somme']?></option>
                  <?php endforeach ?>
                </select>
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
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('date_depart') ?></th>
              <th><?= $this->Paginator->sort('date_arrivee') ?></th>
              <th><?= $this->Paginator->sort('mode_transport') ?></th>
              <th><?= $this->Paginator->sort('nbr_nuit') ?></th>
              <th><?= $this->Paginator->sort('indemnite_kilometrique') ?></th>
              <th><?= $this->Paginator->sort('taux') ?></th>
              <th><?= $this->Paginator->sort('indemnite_appliquee') ?></th>
               <th><?= $this->Paginator->sort('Montant indemnite') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= $this->Paginator->sort('total') ?></th>
              <th><?= $this->Paginator->sort('Id Proffesseur') ?></th>

              <th><?= __('Actions') ?></th>
            </tr>
                <?php foreach ($resultat as $resultats): ?>
              <tr>
                <td><?=$resultats[0]?></td>
                <td><?=$resultats[1]?></td>
                <td><?=$resultats[2]?></td>
                <td><?=$resultats[3]?></td>
                <td><?=$resultats[4]?></td>
                <td><?=$resultats[5]?></td>
                <td><?=$resultats[6]?></td>
                <td><?=$resultats[7]?></td>
                <td><?=$resultats[8]?></td>
                <td><?=$resultats[9]?></td>
                <td><?=$resultats[10]?></td> 
                <td><?=$resultats[12]?></td>  
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('modifier'), ['action' => 'modifierMissionProf', $resultats[0]], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteProf', $resultats[0]], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr> 
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
