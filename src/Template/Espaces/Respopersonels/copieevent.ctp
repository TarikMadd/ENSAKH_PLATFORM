<!-- Content Header (Page header) -->
<section class="content-header">
<div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Professeurs Grades</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="activiteCherch" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
  <h1>
        <div class="pull-right"><?= $this->Html->link(__('Ajouter Activité'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>

    <div class="pull-right"><?= $this->Html->link(__('Ajouter un membre Comité'), ['action' => 'affecterProfEvnt'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"> - La liste des activités organisés par les profs permanents de l'ENSA KHOURIBGA :</h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">

                <span class="input-group-btn">

                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>

              <th><?= $this->Paginator->sort('Nom Activité') ?></th>

                <th><?= $this->Paginator->sort('Date de l\'événement') ?></th>

              <th><?= __('Comité') ?></th>
            </tr>
              <?php $precedent[1]=0;?>
                        <?php foreach ($profpermanentsActivites as $professeursActivite): ?>
                        <?php if(!in_array($professeursActivite->activite->id,$precedent))
                        {
                          array_push($precedent,$professeursActivite->activite->id);
                        ?>
                          <tr>


                          <td><?= h($professeursActivite->activite->nomActivite)?></td>


                             <td><?= h($professeursActivite->activite->dateDebut)?></td>


                                  <td class="actions" style="white-space:nowrap">

                                                   <?= $this->Form->postLink(__('Organisateurs'), ['controller' => 'Respopersonels', 'action' => 'listerOrganisateur', $professeursActivite->activite->id] , ['class'=>'btn btn-info btn-xs']) ?>
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