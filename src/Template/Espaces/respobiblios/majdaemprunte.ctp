<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Emprunts
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">La Liste des emprunts</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm">
                <?php echo $this->Form->input('categorie', ['label' => '','empty'=> '(choisissez une Catégorie)','options' => $categorie, 'onchange'=>"this.form.submit()"]);?>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr >
              <th><?= $this->Paginator->sort('utilisateurs') ?></th>
              <th><?= $this->Paginator->sort('role') ?></th>
              <th><?= $this->Paginator->sort('titre ouvrage') ?></th>
              <th><?= $this->Paginator->sort('numéro Inventaire') ?></th>
              <th><?= $this->Paginator->sort('date Emprunte') ?></th>
              <th><?= $this->Paginator->sort('delai') ?></th>
              <th><?= __('Etat') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php for ($i=0;$i<count($empreinter);$i++) { ?>
              <tr>
                <td><?= $empreinter[$i]['username'] ?></td>
                <td><?= $empreinter[$i]['role'] ?></td>
                <td><?= $empreinter[$i]['titre'] ?></td>
                <td><?= $empreinter[$i]['numInventaire'] ?></td>
                <td><?= $empreinter[$i]['dateEmprunte'] ?></td>
                <td><?= $empreinter[$i]['delai'] ?></td>
                <td class="etat" style="white-space:nowrap">
                  <?php 
                    if (in_array($empreinter[$i]['id'], $deppassement)) echo '<button type="button" type="button" style="padding: 3px 8px" class="btn btn-danger btn-xs"></button>';
                    else echo '<button type="button" type="button" class="btn btn-success btn-xs"></button>'; ?>
                </td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Form->postLink(__('annuler'), ['action' => 'majdasupprimerEmprunte', $empreinter[$i]['id']], ['confirm' => __("Confirmer la sppression de l'ouvrage?"), 'class'=>'btn btn-danger btn-xs']) ?>
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
