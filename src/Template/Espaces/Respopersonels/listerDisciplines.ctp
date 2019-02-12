<!-- Content Header (Page header) -->
<section class="content-header">

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="chercherDisc" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
        <div class="panel panel-primary">
         <div class="panel-heading">Disciplines Enseignés au sein de l'établissement : </div>
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('Somme') ?></th>
              <th><?= $this->Paginator->sort('Nom Professeur') ?></th>
                <th><?= $this->Paginator->sort('Prenom Professeur') ?></th>
              <th><?= $this->Paginator->sort('Element') ?></th>
              <th><?= $this->Paginator->sort('Module') ?></th>
              <th><?= $this->Paginator->sort('Semestre') ?></th>
              <th><?= $this->Paginator->sort('Niveau') ?></th>
              <th><?= $this->Paginator->sort('Filiere') ?></th>
              <th><?= $this->Paginator->sort('Annee Scolaire') ?></th>


              <th><?= __('Actions') ?></th>
            </tr>

            <?php foreach ($disciplines as $enseigner): ?>
              <tr>
               <td><?= h($enseigner['somme'])?></td>
               <td><?= h($enseigner['nomprof'])?></td>
               <td><?= h($enseigner['prenomprof'])?></td>
               <td><?= h($enseigner['element'])?></td>
               <td><?= h($enseigner['module'])?></td>
                <td><?= h($enseigner['semestre'])?></td>
                <td><?= h($enseigner['niveau'])?></td>
               <td><?= h($enseigner['filiere'])?></td>
               <td><?= h($enseigner['AN'])?></td>


                <td class="actions" style="white-space:nowrap">

                  <?= $this->Form->postLink(__('Delete'), ['action' => 'deleteDiscipline', $enseigner['IDe']], ['confirm' => __('Voulez vous que ce professeur n\'enseigne plus cet élément ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
