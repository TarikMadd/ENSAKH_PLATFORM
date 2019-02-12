<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des vacataires
    <div class="pull-right">
       <br>
      <?= $this->Html->link(__('Imprimer.la.Liste'), ['action' => 'printListeVacataire'], ['class'=>'btn btn-primary btn-xs',
        'class'=>'glyphicon glyphicon-duplicate']) ?></div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <b >Recherche par : Nom, Prenom, N de somme, Email, Lieu de naissance, Grade, Echelon ou indice de grade  </b>
          <div class="box-tools">
            <form method="post" action="rechercherVac">
              <div class="input-group input-group-sm"  style="width: 300px;">
                <input type="text" name="chercherProf" class="form-control" placeholder="<?= __('Rechercher un vacataire') ?>">
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
                <th scope="col"><?= $this->Paginator->sort('CIN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_vacataire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_vacataire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nb_heures') ?></th>
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
                <td><?= h($vacataire->dateRecrut) ?></td>
                <td><?= h($vacataire->dateAffectation) ?></td>
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__('View'), ['action' => 'viewvacataire', $vacataire->id], ['class'=>'btn btn-success btn-xs']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editvacataire', $vacataire->id], ['class'=>'btn btn-info btn-xs']) ?>
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
