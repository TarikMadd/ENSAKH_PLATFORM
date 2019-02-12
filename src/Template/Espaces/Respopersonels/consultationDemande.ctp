<!-- Content Header (Page header) -->
<section class="content-header">


  <?php
  foreach ($profpermanentsDocuments as $documentsProfesseur)
  {
  $nom=$documentsProfesseur->profpermanent->nom_prof;
  $prenom=$documentsProfesseur->profpermanent->prenom_prof;
   break;
  }
  if(!isset($nom))
  {
   ?> <div class="panel-heading">Aucune Demande n'a été déposé</div>  <?php
  }
  else
  {
?><div class="panel panel-primary">
    <div class="panel-heading">Demandes déposées par : <?php echo $nom .' '.$prenom; }
?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('somme') ?></th>
              <th><?= $this->Paginator->sort('Date Demande') ?></th>
              <th><?= $this->Paginator->sort('Document') ?></th>
              <th><?= $this->Paginator->sort('Etat Demande') ?></th>


              <th><?= __('Actions') ?></th>
            </tr>

            <?php foreach ($profpermanentsDocuments as $documentsProfesseur): ?>
               <?php

?>
              <tr>


              <td><?= h($documentsProfesseur->profpermanent->somme)?></td>
                  <td><?= h($documentsProfesseur->dateDemande)?></td>
                 <td><?= h($documentsProfesseur->document->nomDocument)?></td>
                 <td><?= h($documentsProfesseur->etatdemande)?></td>
                <td class="actions" style="white-space:nowrap">

                                                 <?php
                                                 if(strcmp($documentsProfesseur->etatdemande, 'Demande envoyé') == 0)
                                                 {
                                                     echo $this->Html->link(__('Approuver'), ['action' => 'approuverDemande', $documentsProfesseur->document_id,$documentsProfesseur->profpermanent_id, $documentsProfesseur->id], ['class'=>'btn btn-info btn-xs']  );
                                                        
                                                     
                                                 }
                                                 elseif($documentsProfesseur->etatdemande=='En cours de traitement')
                                                 {
                                                 echo $this->Html->link(__('Imprimer'), ['action' => 'imprimerDocument', $documentsProfesseur->document_id,$documentsProfesseur->profpermanent_id, $documentsProfesseur->id], ['class'=>'btn btn-warning btn-xs']  ) ;
                                                     
                                                      echo " " ;
                                                        echo $this->Html->link(__('Delivrer'), ['action' => 'DelivrerDemande', $documentsProfesseur->document_id,$documentsProfesseur->profpermanent_id, $documentsProfesseur->id], ['class'=>'btn btn-info btn-xs']  );
                                                  }
                                                 elseif($documentsProfesseur->etatdemande=='Prete')
                                                 {
                                               echo $this->Html->link(__('Delivrer'), ['action' => 'DelivrerDemande', $documentsProfesseur->document_id,$documentsProfesseur->profpermanent_id, $documentsProfesseur->id], ['class'=>'btn btn-info btn-xs']  );

                                                 }

                                                 ?>

                                     </td>
                        </tr><?php

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
