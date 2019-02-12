<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  <?php foreach ($ProfpermanentsDocuments as $documentsProfesseur)
  {
  $nom=$documentsProfesseur->profpermanent->nom_prof;
  $prenom=$documentsProfesseur->profpermanent->prenom_prof;
   break;
  }
  ?>



  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="panel panel-primary"><?php
        if (!isset($nom))
         {?>
          <div class="panel-heading">Aucune Demande n'a été déposée </div><?php
         }
         else{?>
          <div class="panel-heading">Demandes déposées par : <?= $nom ?>  <?= $prenom?><?php
         }

?>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('SOMME') ?></th>
              <th><?= $this->Paginator->sort('DATE DEMANDE') ?></th>
              <th><?= $this->Paginator->sort('NOM DOCUMENT') ?></th>
              <th><?= $this->Paginator->sort('ETAT DOCUMENT') ?></th>



            </tr>

            <?php foreach ($ProfpermanentsDocuments as $documentsProfesseur): ?>


              <tr>


              <td><?= h($documentsProfesseur->profpermanent->somme)?></td>
                  <td><?= h($documentsProfesseur->dateDemande)?></td>
                 <td ><?= h($documentsProfesseur->document->nomDocument)?></td>
                 <td class='btn btn-danger btn-xs'><?= h($documentsProfesseur->etatdemande)?></td>

                 <?php

            endforeach; ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
