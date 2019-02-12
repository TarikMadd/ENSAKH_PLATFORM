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
              <select name="categorie" onchange="this.form.submit();">
              <option value="inf">tout les emprunts</option>
                <?php 
                for ($i=0; $i <count($categorie) ; $i++) { 
                	if(isset($selection)){ ?>
                	<option value="<?= $categorieId[$i];?>" <?php if($selection == "$categorieId[$i]") echo"selected" ?>><?= $categorie[$i];?></option>
                <?php }else { ?>
                	<option value="<?= $categorieId[$i];?>"><?= $categorie[$i];?></option>
                <?php }} ?>
                </select>
            </form>
          </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('utilisateurs') ?></th>
              <th><?= $this->Paginator->sort('role') ?></th>
              <th><?= $this->Paginator->sort('titre ouvrage') ?></th>
              <th><?= $this->Paginator->sort('numéro Inventaire') ?></th>
              <th><?= $this->Paginator->sort('date Emprunte') ?></th>
              <th><?= $this->Paginator->sort('dérnier delai') ?></th>
            </tr>
            <?php for ($i=0;$i<count($depasser);$i++) { ?>
              <tr>
                <td><?= $depasser[$i]['username'] ?></td>
                <td><?= $depasser[$i]['role'] ?></td>
                <td><?= $depasser[$i]['titre'] ?></td>
                <td><?= $depasser[$i]['numInventaire'] ?></td>
                <td><?= $depasser[$i]['dateEmprunte'] ?></td>
                <td><?= $depasser[$i]['delai'] ?></td>
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
