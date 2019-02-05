<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des fonctionnaires
    <div class="pull-right">
      <?= $this->Html->link(__('Nouveau.fonctionnaire'), ['action' => 'addfonc'], ['class'=>'btn btn-primary btn-xs',
      'class'=>'glyphicon glyphicon-user']) ?> <br>
      <?= $this->Html->link(__('Imprimer.la.Liste'), ['action' => 'printListeFonctionnaire'], ['class'=>'btn btn-primary btn-xs',
        'class'=>'glyphicon glyphicon-duplicate']) ?></div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          
          <div class="box-tools">
            <form method="post" action="exportFonctionnaire">
              <div class="input-group input-group-sm"  style="width: 300px;">
                <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher un fonctionnaire par son nom') ?>">
                <span class="input-group-btn">
                <button class="btn btn-warning btn-xs" type="submit"><?= __('Rechercher') ?></button>
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
                <th scope="col"><?= $this->Paginator->sort('nom_fct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_fct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_Recrut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('etat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('specialite') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fonctionnaires as $fonctionnaire): ?>
            <tr>
                <td><?= h($fonctionnaire->nom_fct) ?></td>
                <td><?= h($fonctionnaire->prenom_fct) ?></td>
                <td><?= h($fonctionnaire->date_Recrut) ?></td>
                <td><?= $this->Number->format($fonctionnaire->etat) ?></td>        
                <td><?= h($fonctionnaire->specialite) ?></td>
                 <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__('View'), ['action' => 'viewfonctionnaire', $fonctionnaire->id], ['class'=>'btn btn-success btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editfonctionnaire', $fonctionnaire->id], ['class'=>'btn btn-info btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'deletefonctionnaire', $fonctionnaire->id], ['confirm' => __('Voulez vous vraiment supprimer ce champ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   <!-- /.box-body -->
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
