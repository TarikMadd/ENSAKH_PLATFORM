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
          <h3 class="box-title"><?= __('liste des missions du fonctionnaire: ').$r[0].' '.$r[1].' '.$r[2];?></h3>
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
              <th><?= $this->Paginator->sort('date_depart') ?></th>
              <th><?= $this->Paginator->sort('date_arrivee') ?></th>
              <th><?= $this->Paginator->sort('mode_transport') ?></th>
              <th><?= $this->Paginator->sort('nbr_nuit') ?></th>
              <th><?= $this->Paginator->sort('indemnite_kilometrique') ?></th>
              <th><?= $this->Paginator->sort('taux') ?></th>
              <th><?= $this->Paginator->sort('indemnite_appliquee') ?></th>
              <th><?= $this->Paginator->sort('Montant indemnite') ?></th>
              <th><?= $this->Paginator->sort('Motif') ?></th>
              <th><?= $this->Paginator->sort('total') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($resultat as $resultats): ?>
              <tr>
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
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('modifier'), ['action' => 'modifierMissionFonc', $resultats[0]], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteFonc', $resultats[0]], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
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
<table>
  <tr>
    <td width="40%">Fiche1 :  </td>
    <td><?= $this->Html->link(__(' Ordre de paiement '), ['action' => 'imprimerFiche1Fonc',$id], ['target'=> '_blank','class'=>'btn btn-success btn-xs']) ?></td>
  </tr>
  <tr>
   <td>Fiche2 :  </td>
    <td><?= $this->Html->link(__('Etat des sommes dues'), ['action' => 'imprimerFiche2Fonc',$id], ['target'=> '_blank' ,'class'=>'btn btn-info btn-xs']) ?></td>
  </tr>
  <tr>
    <td>Fiche1 :  </td>
    <td><?= $this->Html->link(__(' ORDRE DE MISSION '), ['action' => 'imprimerFiche3Fonc',$id], ['target'=> '_blank', 'class'=>'btn btn-warning btn-xs']) ?></td>
  </tr>
</table>
    </div>
  <div class="col-xs-6">
    <h4>imprimer les fiches de l'indemnité kilométrique</h4>
  
        <table>
          <tr>
            <td width="40%">Fiche1 :  </td>
            <td><?= $this->Html->link(__('Ordre de paiement'), ['action' => 'imprimerFiche4Fonc',$id], ['target'=> '_blank','class'=>'btn btn-success btn-xs']) ?></td>
          </tr>
          <tr>
           <td>Fiche2 :  </td>
            <td><?= $this->Html->link(__('Etat des sommes dues'), ['action' => 'imprimerFiche5Fonc',$id], ['target'=> '_blank','class'=>'btn btn-info btn-xs']) ?></td>
          </tr>
          <tr>
            <td>Fiche3 :  </td>
            <td><?= $this->Html->link(__('ORDRE DE MISSIONS'), ['action' => 'imprimerFiche6Fonc',$id], ['target'=> '_blank', 'class'=>'btn btn-warning btn-xs']) ?></td>
          </tr>
          <tr>
            <td>Fiche4 :  </td>
            <td><?= $this->Html->link(__('  DECISION  '), ['action' => 'imprimerFiche7Fonc',$id], ['target'=> '_blank', 'class'=>'btn btn-danger btn-xs']) ?></td>
          </tr>
        </table>
    </div>
  </div>
</section>