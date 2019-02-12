<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des professeurs qui ont déposés des demandes de certificats :
      </h1>
    <div class="box-header">
            <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="search" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        
        </div>
        <!-- /.box-header -->
         <div class="panel panel-primary">
          

          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('NOM PROFESSEUR') ?></th>
              <th><?= $this->Paginator->sort('PRENOM PROFESSEUR') ?></th>

              <th><?= __('ACTIONS ') ?></th>
            <?php $precedent[1]=0;?>
            <?php foreach ($ProfpermanentsDocuments as $documentsProfesseur): ?>
            <?php

             if(!in_array($documentsProfesseur->profpermanent->id,$precedent)&& strcmp($documentsProfesseur->etatdemande, 'Demande envoyé') == 0)
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
