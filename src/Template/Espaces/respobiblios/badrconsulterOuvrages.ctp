<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ouvrages
    <div class="pull-right"><?= $this->Html->link(__('Ajouter un ouvrage'), ['action' => 'badrajouterOuvrages'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header">
          <h3 class="box-title">Les Ouvrages Disponible</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 300px;">
                <?php echo $this->Form->input('numInventaire', ['label' => '','placeholder'=> 'chercher par numInventaire']);?>
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit" style="height: 33px;"><?= __('Filter') ?></button>
                </span>
                </span>
              </div>
            </form>
          </div>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('numero Inventaire') ?></th>
              <th><?= $this->Paginator->sort('titre') ?></th>
              <th><?= $this->Paginator->sort('auteur') ?></th>
              <th><?= $this->Paginator->sort('édition') ?></th>
              <th><?= $this->Paginator->sort('resumer') ?></th>
              <th><?= $this->Paginator->sort('ISBN') ?></th>
              <th><?= __('Etat') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php for ($i=0;$i<count($book);$i++) { ?>
              <tr>
                <td><?= $book[$i]['numInventaire'] ?></td>
                <td><?= $book[$i]['titre'] ?></td>
                <td><?= $book[$i]['auteur'] ?></td>
                <td><?= $book[$i]['edition'] ?></td>
                <td><?= $book[$i]['resumer'] ?></td>
                <td><?= $book[$i]['ISBN'] ?></td>
                <td class="Etat" style="white-space:nowrap">
                  <?php 
                    if (in_array($book[$i]['id'], $empreinte)) echo '<button type="button" type="button" class="btn btn-danger btn-xs">empreintée</button>';
                    else if (in_array($book[$i]['id'], $reservation)) echo '<button type="button" type="button" class="btn btn-warning btn-xs">résérvée</button>';
                    else echo '<button type="button" type="button" class="btn btn-success btn-xs">disponible</button>'; ?>
                </td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Edit'), ['action' => 'badrmodifier', $book[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['action' => 'badrsupprimer', $book[$i]['id']], ['confirm' => __("Confirmer la sppression de l'ouvrage?"), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php } ?>
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
