<!-- Content Header (Page header) -->
<section class="content-header">
    <h4>
       <strong>Mouvement des fonctionnaires</strong>
    </h4>
</section>
<?php
$i=1;
foreach ($fonctionnairesServices as $fonctionnairesService)
{
    $suivant[$i]=$fonctionnairesService->fonctionnaire_id;
    $i++;
}?>



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
                            <th><?= $this->Paginator->sort('Nom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Prénom Fonctionnaire') ?></th>
                            <th><?= $this->Paginator->sort('Nom Service ') ?></th>
                            <th><?= $this->Paginator->sort('date Début') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        <?php
                        $j=1;
                        foreach ($fonctionnairesServices as $fonctionnairesService)
                        {
                            if(!isset($suivant[$j+1])||$suivant[$j+1]<>$fonctionnairesService->fonctionnaire_id)
                            {?>
                                <tr>
                                    <td><?= h($fonctionnairesService->fonctionnaire->nom_fct) ?></td>
                                    <td><?= h($fonctionnairesService->fonctionnaire->prenom_fct) ?></td>
                                    <td><?= h($fonctionnairesService->service->nom_service) ?></td>
                                    <td><?= h($fonctionnairesService->date_debut) ?></td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?= $this->Html->link(__('Consulter'), ['action' => 'viewServiceFct', $fonctionnairesService->fonctionnaire_id], ['class'=>'btn btn-info btn-xs']  ) ?>
                                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteFonctService2', $fonctionnairesService->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs']) ?>

                                    </td>
                                </tr>
                                <?php
                                $j++;}
                                else{
                                $j++;}
                        }

                        ?>
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
