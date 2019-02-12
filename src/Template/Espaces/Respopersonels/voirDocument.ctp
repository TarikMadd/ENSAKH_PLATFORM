<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">


        </div>
        <!-- /.box-header -->
              <div class="panel panel-primary">
             <div class="panel-heading"> - Liste des professeurs qui ont déposé des demandes de certificats :</div>
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('NOM PROFESSEUR') ?></th>
              <th><?= $this->Paginator->sort('PRENOM PROFESSEUR') ?></th>

              <th><?= __('Actions') ?></th>
            </tr>
            <?php $precedent[1]=0;?>
            <?php foreach ($ProfpermanentsDocuments as $documentsProfesseur): ?>
            <?php

             if(!in_array($documentsProfesseur->profpermanent->id,$precedent))
            {
            array_push($precedent,$documentsProfesseur->profpermanent->id);

            ?>
              <tr>

              <td><?= h($documentsProfesseur->profpermanent->nom_prof)?></td>
                 <td><?= h($documentsProfesseur->profpermanent->prenom_prof)?></td>
                      <td class="actions" style="white-space:nowrap">

                                       <?= $this->Form->postLink(__('Voir Documents'), ['action' => 'ConsultationDemande', $documentsProfesseur->profpermanent->id], [ 'class'=>'btn btn-danger btn-xs']) ?>
                                     </td>


              </tr><?php }

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
