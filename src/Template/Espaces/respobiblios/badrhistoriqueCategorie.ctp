<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Historiques
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">La liste des emprunts</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <select name="categorie" onchange="this.form.submit();">
              <option value="inf">tout les catégories</option>
                <?php 
                for ($i=0; $i <count($categorie) ; $i++) { 
                  if(isset($selection)){ ?>
                  <option value="<?= $categorieId[$i];?>" <?php if($selection == "$categorieId[$i]") echo"selected" ?>><?= $categorie[$i];?></option>
                <?php }else { ?>
                  <option value="<?= $categorieId[$i];?>"><?= $categorie[$i];?></option>
                <?php }} ?>
                </select>
                <select name="souscategorie" onchange="this.form.submit();" <?php if(!isset($selection)) echo "disabled";?>>
                  <option value="inf1">tout les sous catégories</option>
                  <?php 
                  for ($i=0; $i <count($souscategorie) ; $i++) { 
                      if(isset($selection1)){ ?>
                    <option value="<?= $souscategorieId[$i];?>" <?php if($selection1 == "$souscategorieId[$i]") echo"selected" ?>><?= $souscategorie[$i];?></option>
                  <?php }else { ?>
                    <option value="<?= $souscategorieId[$i];?>"><?= $souscategorie[$i];?></option>
                  <?php }} ?>
                </select>
            </form>
          </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('titre') ?></th>
              <th><?= $this->Paginator->sort('numéro Inventaire') ?></th>
              <th><?= $this->Paginator->sort('utilisateur') ?></th>
              <th><?= $this->Paginator->sort('fonction') ?></th>
              <th><?= $this->Paginator->sort('identifiant') ?></th>
              <th><?= $this->Paginator->sort('dateEmprunte') ?></th>
              <th><?= $this->Paginator->sort('date Retour') ?></th>
            </tr>
            <?php if (isset($emprunt)) {
            for ($i=0;$i<count($emprunt);$i++) { ?>
              <tr>
                <td><?= $emprunt[$i]['titre'] ?></td>
                <td><?= $emprunt[$i]['numInventaire'] ?></td>
                <td><?= $emprunt[$i]['username'] ?></td>
                <td><?= $emprunt[$i]['role'] ?></td>
                <td><?= $emprunt[$i]['id'] ?></td>
                <td><?= $emprunt[$i]['dateEmprunte'] ?></td>
                <td><?= $emprunt[$i]['dateRetour'] ?></td>
              </tr>
            <?php }} ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->