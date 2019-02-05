<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Emprunts</h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List des emprunts') ?></h3>
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
              <th><?= $this->Paginator->sort('Delai') ?></th>
              <th><?= $this->Paginator->sort('Etat') ?></th>
            </tr>
            <?php for ($i=0;$i<count($empreinte);$i++) { ?>
              <tr>
                <td><?= $empreinte[$i]['titre'] ?></td>
                <td><?= $empreinte[$i]['auteur'] ?></td>
                <td><?= $empreinte[$i]['ISBN'] ?></td>
                <td><?= $empreinte[$i]['numInventaire'] ?></td>
                <td><?= $empreinte[$i]['dateEmprunte'] ?></td>
                <td><?= $empreinte[$i]['delai'] ?></td>
                <td class="Etat" style="white-space:nowrap">
                  <?php 
                $date1=date_create(date('Y-m-d H:i:s'));
                $date2=date_create($empreinte[$i]['delai']);
                $diff=date_diff($date1,$date2);
                if ($diff->format("%R%a")<0){
                  echo '<button type="button" type="button" class="btn btn-danger btn-xs">delai depassé</button>';}
                else if ($diff->format("%R%a")==0) {
                  echo '<button type="button" type="button" class="btn btn-warning btn-xs">dernier jour</button>';}
                else {
                  echo '<button type="button" type="button" class="btn btn-success btn-xs">bonne lecture</button>';} 
                    ?>
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
