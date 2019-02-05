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
                    <dd><?= $this->Html->link(__('Etat de Prelevement '), ['action' => 'etatPrelevement', $prelevement->id], ['class'=>'btn bg-maroon btn-flat margin']) ?> </dd>
                    <dd><?= $this->Html->link(__('Ordre de paiement'), ['action' => 'opVacPre', $prelevement->id], ['class'=>'btn bg-purple btn-flat margin']) ?> </dd>
                    <dd><?= $this->Html->link(__('Ordre de paiement Rap'), ['action' => 'opVacRapPre', $prelevement->id], ['class'=>'btn bg-orange btn-flat margin']) ?> </dd>

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

                <?php if (!empty($prelevement->paimentvacs)): ?>

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

                            <?php foreach ($prelevement->paimentvacs as $paimentvac): ?>
                                <tr>

                                    <td><?= $this->Number->format($paimentvac->Numero) ?></td>
                                    <td><?= h(' Du '.$paimentvac->dateDebut->format('d/m/Y').' Au '.$paimentvac->dateFin->format('d/m/Y')) ?></td>
                                    <td><?= h($paimentvac->cheque) ?></td>
                                    <td><?= $this->Number->format($paimentvac->montantBrut, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td><?= $this->Number->format($paimentvac->Impot, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    <td><?= $this->Number->format($paimentvac->MontantNet, ['places' => 2, 'locale' => 'fr_FR']) ?></td>
                                    </td>
                                    
                                   <td class="actions">
                                    <?= $this->Html->link(__('Afficher'), ['action' => 'viewpaimentvacss', $paimentvac->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Modifier'), ['action' => 'editpaimentvacs', $paimentvac->id], ['class'=>'btn btn-warning btn-xs']) ?>
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
