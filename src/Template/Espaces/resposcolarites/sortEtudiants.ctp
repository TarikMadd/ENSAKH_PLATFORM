
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Articles
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'add_articles'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Etudiants</h3>
          <div class="box-tools">
            <form method="POST" action="exportEtudiants">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" name="afficher" type="submit"><?= __('Rechercher')  ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_fr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_ar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apogee') ?></th>
            </tr>
            <?php foreach ($etudiants as $etudiant): ?>
             <tr>
                <td><?= $this->Number->format($etudiant->id) ?></td>
                <td><?= h($etudiant->nom_fr) ?></td>
                <td><?= h($etudiant->nom_ar) ?></td>
                <td><?= h($etudiant->apogee) ?></td>
				
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