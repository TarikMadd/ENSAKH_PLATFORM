<section class="content-header">
  <h1>
    <?php echo __('Courrier Depart'); ?>
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
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                                <dt><?= __('Objet Depart') ?></dt>
                                        <dd>
                                            <?= h($courrierDepart->objet_depart) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Service Depart') ?></dt>
                                        <dd>
                                            <?= h($courrierDepart->service_depart) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Expediteur') ?></dt>
                                <dd>
                                    <?= $courrierDepart->has('expediteur') ? $courrierDepart->expediteur->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Type Courrier') ?></dt>
                                        <dd>
                                            <?= h($courrierDepart->type_courrier) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Chemin Courier') ?></dt>
                                        <dd>
                                            <?= h($courrierDepart->chemin_courier) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Chemin Accuse') ?></dt>
                                        <dd>
                                            <?= h($courrierDepart->chemin_accuse) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                            
                                                                                                        <dt><?= __('Date Depart') ?></dt>
                                <dd>
                                    <?= h($courrierDepart->date_depart) ?>
                                </dd>
                                                                                                    
                                            
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
                    <h3 class="box-title"><?= __('Related {0}', ['Destinataires']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($courrierDepart->destinataires)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    NomComplet Destinataire
                                    </th>
                                        
                                                                    
                                    <th>
                                    Adresse Destinataire
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email Destinataire
                                    </th>
                                        
                                                                    
                                    <th>
                                    Telephone Destinataire
                                    </th>
                                        
                                                                    
                                    <th>
                                    Service Destinataire
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($courrierDepart->destinataires as $destinataires): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($destinataires->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($destinataires->nomComplet_destinataire) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($destinataires->adresse_destinataire) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($destinataires->email_destinataire) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($destinataires->telephone_destinataire) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($destinataires->service_destinataire) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Destinataires', 'action' => 'view', $destinataires->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Destinataires', 'action' => 'edit', $destinataires->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Destinataires', 'action' => 'delete', $destinataires->id], ['confirm' => __('Are you sure you want to delete # {0}?', $destinataires->id), 'class'=>'btn btn-danger btn-xs']) ?>    
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
