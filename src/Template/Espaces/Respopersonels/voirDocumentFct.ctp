<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des fonctonnaires qui ont déposés des demandes de certificats :
      </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Les documents des fonctionnaires </h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">


              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('nom_fct') ?></th>
              <th><?= $this->Paginator->sort('prenom_fct') ?></th>

              <th><?= __('Actions') ?></th>
            </tr>
            <?php $precedent[1]=0;?>
            <?php foreach ($fonctionnairesDocuments as $documentsProfesseur): ?>
            <?php

             if(!in_array($documentsProfesseur->fonctionnaire->id,$precedent))
            {
            array_push($precedent,$documentsProfesseur->fonctionnaire->id);

            ?>
              <tr>

              <td><?= h($documentsProfesseur->fonctionnaire->nom_fct)?></td>
                 <td><?= h($documentsProfesseur->fonctionnaire->prenom_fct)?></td>
                      <td class="actions" style="white-space:nowrap">

                                       <?= $this->Form->postLink(__('Voir Documents'), ['action' => 'ConsultationDemandeFct', $documentsProfesseur->fonctionnaire->id], [ 'class'=>'btn btn-danger btn-xs']) ?>
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
