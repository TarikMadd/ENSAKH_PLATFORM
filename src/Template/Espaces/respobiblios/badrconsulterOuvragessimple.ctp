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

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('titre') ?></th>
              <th><?= $this->Paginator->sort('auteur') ?></th>
              <th><?= $this->Paginator->sort('édition') ?></th>
              <th><?= $this->Paginator->sort('resumer') ?></th>
              <th><?= $this->Paginator->sort('ISBN') ?></th>
              <th><?= $this->Paginator->sort('nombre exemplaire') ?></th>
            </tr>
            <?php for ($i=0;$i<count($book);$i++) { ?>
              <tr>
                <td><?= $book[$i]['titre'] ?></td>
                <td><?= $book[$i]['auteur'] ?></td>
                <td><?= $book[$i]['edition'] ?></td>
                <td><?= $book[$i]['resumer'] ?></td>
                <td><?= $book[$i]['ISBN'] ?></td>
                <td><?= $book[$i]['nbExemplaire'] ?></td>
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
