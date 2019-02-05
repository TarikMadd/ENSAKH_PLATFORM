<section class="content-header">
  <h1>
    Missions
    <div class="pull-right"><?= $this->Html->link(__('New'), ['action' => 'ajouterMission'], ['class'=>'btn btn-success btn-xs']) ?>
    </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Missions</h3>
          <div class="box-tools">
            <form name="Recherche" action="afficherFonc" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <select name="search" class="form-control" >
                  <?php foreach ($fonctionnaires as $fonc): ?>
                      <option value=<?php echo $fonc['id']?>> <?php echo $fonc['somme']?></option>
                  <?php endforeach ?>
                </select>
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('date_depart') ?></th>
              <th><?= $this->Paginator->sort('date_arrivee') ?></th>
              <th><?= $this->Paginator->sort('mode_transport') ?></th>
              <th><?= $this->Paginator->sort('nbr_nuit') ?></th>
              <th><?= $this->Paginator->sort('indemnite_kilometrique') ?></th>
              <th><?= $this->Paginator->sort('taux') ?></th>
              <th><?= $this->Paginator->sort('indemnite_appliquee') ?></th>
              <th><?= $this->Paginator->sort('Montant indemnite') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= $this->Paginator->sort('total') ?></th>
            </tr>
            <?php foreach ($resultat as $resultats): ?>
              <tr>
                <td><?=$resultats[0]?></td>
                <td><?=$resultats[1]?></td>
                <td><?=$resultats[2]?></td>
                <td><?=$resultats[3]?></td>
                <td><?=$resultats[4]?></td>
                <td><?=$resultats[5]?></td>
                <td><?=$resultats[6]?></td>
                <td><?=$resultats[7]?></td>
                <td><?=$resultats[8]?></td>
                <td><?=$resultats[9]?></td>
                <td><?=$resultats[10]?></td>
              </tr>  
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        </div>
      </div>
      <!-- /.box -->
    </div>
    <div class="col-xs-6">
    <h4>imprimer les fiches de l'indemnité appliquée</h4>
  <ul>
    <li>
      <?= $this->Html->link(__('Imprimer Fiche1'), ['action' => 'imprimerFiche1Fonc',$id], ['target'=> '_blank']) ?>
    </li>
    <li>
    <?= $this->Html->link(__('Imprimer Fiche2'), ['action' => 'imprimerFiche2Fonc',$id], ['target'=> '_blank']) ?>
    </li>
    <li>
    <?= $this->Html->link(__('Imprimer Fiche3'), ['action' => 'imprimerFiche3Fonc',$id], ['target'=> '_blank']) ?>
    </li>
  </ul>
    </div>
  <div class="col-xs-6">
    <h4>imprimer les fiches de l'indemnité kilométrique</h4>
        <ul>
              <li>
              <?= $this->Html->link(__('Imprimer Fiche1'), ['action' => 'imprimerFiche4Fonc',$id], ['target'=> '_blank']) ?>
              </li>
              <li>
              <?= $this->Html->link(__('Imprimer Fiche2'), ['action' => 'imprimerFiche5Fonc',$id], ['target'=> '_blank']) ?>
              </li>
              <li>
              <?= $this->Html->link(__('Imprimer Fiche3'), ['action' => 'imprimerFiche6Fonc',$id], ['target'=> '_blank']) ?>
              </li>
              <li>
              <?= $this->Html->link(__('Imprimer Fiche4'), ['action' => 'imprimerFiche7Fonc',$id], ['target'=> '_blank']) ?>
              </li>
        </ul>
    </div>
  </div>
</section>