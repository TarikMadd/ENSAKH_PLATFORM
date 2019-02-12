<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       La liste des fonctionnaires qui ont déposé des demandes de certificats
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
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
                            <th><?= $this->Paginator->sort('Nom fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Prénom fonctionnaire') ?></th>

                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php $precedent=0;?>
                        <?php foreach ($fonctionnairesDocuments as $documentFonctionnaire):
                            if($documentFonctionnaire->fonctionnaire_id<>$precedent )
                            {?>
                                <tr>
                                <td><?= h($documentFonctionnaire->fonctionnaire->nom_fct)?></td>
                                <td><?= h($documentFonctionnaire->fonctionnaire->prenom_fct)?></td>
                                <td class="actions" style="white-space:nowrap">
                              <?= $this->Form->postLink(__('Voir Documents'), ['action' => 'ConsultationDemandeFct', $documentFonctionnaire->fonctionnaire_id], [ 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                                <?php $precedent=$documentFonctionnaire->fonctionnaire_id;?>

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
