<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des vacataires
    <div class="pull-right">
      <?= $this->Html->link(__('Nouveau.vacataire'), ['action' => 'addvac'], ['class'=>'btn btn-primary btn-xs',
      'class'=>'glyphicon glyphicon-user']) ?> <br>
      </div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          
          <div class="box-tools">
            <form method="post" action="exportVacataires">
              <div class="input-group input-group-sm"  style="width:300px;">
                <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher un vacataire par son nom') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Rechercher') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <br>
        <!-- /.box-header -->
<div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('CIN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_vacataire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_vacataire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nb_heures') ?></th>
                <th scope="col"><?= $this->Paginator->sort('echelle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dateRecrut') ?></th>
                 <th scope="col"><?= $this->Paginator->sort('dateAffectation') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($vacataires as $vacataire): ?>
            <tr>
                <td><?= h($vacataire->CIN) ?></td>
                <td><?= h($vacataire->nom_vacataire) ?></td>
                <td><?= h($vacataire->prenom_vacataire) ?></td>
                <td><?= $this->Number->format($vacataire->nb_heures) ?></td>
                <td><?= $this->Number->format($vacataire->echelle) ?></td>
                <td><?= h($vacataire->dateRecrut) ?></td>
                <td><?= h($vacataire->dateAffectation) ?></td>
    
              
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__('View'), ['action' => 'viewvacataire', $vacataire->id], ['class'=>'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editvacataire', $vacataire->id], ['class'=>'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'deletevacataire', $vacataire->id], ['confirm' => __('Voulez vous vraiment supprimer ce champ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    </div>
    <!-- /.box-body -->
        
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
