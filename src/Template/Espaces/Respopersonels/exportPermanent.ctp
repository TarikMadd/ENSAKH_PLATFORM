<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des vacataires
    <div class="pull-right">
      <?= $this->Html->link(__('Nouveau.Prof.Permanent'), ['action' => 'addper'], ['class'=>'btn btn-primary btn-xs',
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
            <form method="post" action="exportPermanent">
              <div class="input-group input-group-sm"  style="width:300px;">
                <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher un Professeur par son nom') ?>">
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
                <th scope="col"><?= $this->Paginator->sort('nom_prof') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_prof') ?></th>
                <th scope="col"><?= $this->Paginator->sort('specialite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_prof') ?></th>
                 <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($profpermanents as $profpermanents): ?>
            <tr>
                <td><?= h($profpermanents->CIN) ?></td>
                <td><?= h($profpermanents->nom_prof) ?></td>
                <td><?= h($profpermanents->prenom_prof) ?></td>
                <td><?= h($profpermanents->specialite) ?></td>
                <td><?= h($profpermanents->email_prof) ?></td>
                <td><?= h($profpermanents->phone) ?></td>
              
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__('View'), ['action' => 'viewprofpermanents', $profpermanents->id], ['class'=>'btn btn-info btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editprofpermanents', $profpermanents->id], ['class'=>'btn btn-warning btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteprofpermanents', $profpermanents->id], ['confirm' => __('Voulez vous vraiment supprimer ce champ?'), 'class'=>'btn btn-danger btn-xs']) ?>
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
