<section class="content-header">
  <h1>
    Historique
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Historique des emprunts') ?></h3>
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
            <tr>
              <th><?= $this->Paginator->sort('Titre') ?></th>
              <th><?= $this->Paginator->sort('Auteur') ?></th>
              <th><?= $this->Paginator->sort('ISBN') ?></th>
              <th><?= $this->Paginator->sort('Num Inventaire') ?></th>
              <th><?= $this->Paginator->sort('Date Empreintes') ?></th>
              <th><?= $this->Paginator->sort('Date retoure') ?></th>

            </tr>
            <?php for ($i=0;$i<count($hempreinte);$i++) { ?>
              <tr>
                <td><?= $hempreinte[$i]['titre'] ?></td>
                <td><?= $hempreinte[$i]['auteur'] ?></td>
                <td><?= $hempreinte[$i]['ISBN'] ?></td>
                <td><?= $hempreinte[$i]['numInventaire'] ?></td>
                <td><?= $hempreinte[$i]['dateEmprunte'] ?></td>
                <td><?= $hempreinte[$i]['dateRetour'] ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
