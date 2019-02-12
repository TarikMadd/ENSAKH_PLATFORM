<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php
        foreach ($fonctionnairesDocuments as $documentsProfesseur)
        {
            $nom=$documentsProfesseur->fonctionnaire->nom_fct;
            $prenom=$documentsProfesseur->fonctionnaire->prenom_fct;
            break;
        }
        if(!isset($nom))
        {
            ?> Aucune Demande n'est déposée actuellement <?php
        }
        else
        {
            ?>
            Demandes déposées par : <?php echo $nom .' '.$prenom; }
        ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Documents Demandés</h3>

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

                        <?php foreach ($fonctionnairesDocuments as $documentsProfesseur): ?>
                            <?php

                            ?>
                            <tr>


                            <td><?= h($documentsProfesseur->fonctionnaire->somme)?></td>
                            <td><?= h($documentsProfesseur->dateDemande)?></td>
                            <td><?= h($documentsProfesseur->document->nomDocument)?></td>
                            <td><?= h($documentsProfesseur->etatdemande)?></td>
                            <td class="actions" style="white-space:nowrap">

                                <?php
                                if(strcmp($documentsProfesseur->etatdemande, 'Demande envoyé') == 0)
                                {
                                    echo $this->Html->link(__('Approuver'), ['action' => 'approuverDemandeFct', $documentsProfesseur->document_id,$documentsProfesseur->fonctionnaire_id, $documentsProfesseur->id], ['class'=>'btn btn-info btn-xs']  );

                                }
                                elseif($documentsProfesseur->etatdemande=='En cours de traitement')
                                {
                                    echo $this->Html->link(__('Imprimer'), ['action' => 'imprimerDocumentFct', $documentsProfesseur->document_id,$documentsProfesseur->fonctionnaire_id, $documentsProfesseur->id], ['class'=>'btn btn-warning btn-xs']  ) ;
                                    echo " ";
                                    echo $this->Html->link(__('Delivrer'), ['action' => 'DelivrerDemandeFct', $documentsProfesseur->document_id,$documentsProfesseur->fonctionnaire_id, $documentsProfesseur->id], ['class'=>'btn btn-info btn-xs']  );

                                }
                                elseif($documentsProfesseur->etatdemande=='Prete')
                                {
                                    echo $this->Html->link(__('Delivrer'), ['action' => 'DelivrerDemandeFct', $documentsProfesseur->document_id,$documentsProfesseur->fonctionnaire_id], ['class'=>'btn btn-info btn-xs']  );

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
