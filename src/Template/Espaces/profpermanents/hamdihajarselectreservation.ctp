<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Espace Bibliothèque
      </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Ouvrages réservés </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('Titre') ?></th>
              <th><?= $this->Paginator->sort('Numéro Inventaire') ?></th>
              <th><?= $this->Paginator->sort('Date Réservation') ?></th>
              <th><?= $this->Paginator->sort('Delai') ?></th>
              <th><?= $this->Paginator->sort('Categorie') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php for ($i=0;$i<count($reservation);$i++) { ?>
              <tr>
                <td><?= $reservation[$i]['titre'] ?></td>
                <td><?= $reservation[$i]['numInventaire'] ?></td>
                <td><?= $reservation[$i]['dateReservation'] ?></td>
                <td><?= $reservation[$i]['delai'] ?></td>
                 <td><?= $reservation[$i]['categorie'] ?></td>
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Form->postLink(__('Annuler'), ['action' => 'hamdihajarannulerreservation', $reservation[$i]['id'], 'confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                 </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
