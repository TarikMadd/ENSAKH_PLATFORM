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
            <?php foreach ($VacatairesDocuments as $documentsProfesseur): ?>
            <?php

             if(!in_array($documentsProfesseur->vacataire->id,$precedent))
            {
            array_push($precedent,$documentsProfesseur->vacataire->id);

            ?>
              <tr>

              <td><?= h($documentsProfesseur->vacataire->nom_vacataire)?></td>
                 <td><?= h($documentsProfesseur->vacataire->prenom_vacataire)?></td>
                      <td class="actions" style="white-space:nowrap">

                                       <?= $this->Form->postLink(__('Voir Documents'), ['action' => 'vacataireDocument', $documentsProfesseur->vacataire->id], [ 'class'=>'btn btn-danger btn-xs']) ?>
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
