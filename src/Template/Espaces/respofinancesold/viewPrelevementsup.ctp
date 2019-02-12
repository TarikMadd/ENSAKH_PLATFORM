<section class="content-header">
  <h1>
    <?php echo __('Prelevement'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"> Exercice : <?= h('Du '.$prelevement->dateDebut->format('d/m/Y') .' Au '.$prelevement->dateFin->format('d/m/Y')) ?></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <dl class="dl-horizontal">
                    <dd><?= $this->Html->link(__('Etat de Prelevement '), ['action' => 'etatPrelevementsup', $prelevement->id], ['class'=>'btn bg-maroon btn-flat margin']) ?> </dd>
                    <dd><?= $this->Html->link(__('Ordre de paiement'), ['action' => 'opSupPre', $prelevement->id], ['class'=>'btn bg-purple btn-flat margin']) ?> </dd>
                    <dd><?= $this->Html->link(__('Ordre de paiement Rap'), ['action' => 'opSupRapPre', $prelevement->id], ['class'=>'btn bg-orange btn-flat margin']) ?> </dd>

                </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Paiements associés') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($prelevement->paimentsups)): ?>

                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th scope="col">Numéro</th>
                            <th scope="col">Exercice</th>
                            <th scope="col">Chéque</th>
                            <th scope="col">Montant Brut </th>
                            <th scope="col">Taux IGR </th>
                            <th scope="col">Montant NET </th>

                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>

                            <?php foreach ($prelevement->paimentsups as $paimentsup): ?>
                                <tr>

                                    <td><?= $this->Number->format($paimentsup->Numero) ?></td>
                                    <td><?= h(' Du '.$paimentsup->dateDebut->format('d/m/Y').' Au '.$paimentsup->dateFin->format('d/m/Y')) ?></td>
                                    <td><?= h($paimentsup->cheque) ?></td>
                                    <td><?= $this->Number->format($paimentsup->montantBrut, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td><?= $this->Number->format($paimentsup->Impot, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td><?= $this->Number->format($paimentsup->MontantNet, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    </td>
                                    
                                   <td class="actions">
                                    <?= $this->Html->link(__('Afficher'), ['action' => 'viewpaimentsup', $paimentsup->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editpaimentsup', $paimentsup->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
