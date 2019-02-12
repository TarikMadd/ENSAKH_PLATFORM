<section class="content-header">
  <h1>
    <?php echo __('Vacation'); ?>
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
        <div class="box box-sol1id">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                         <dt><?= __('Etat') ?></dt>                                                                       
                                        <dd>
                                            <?= h($vacation->etat) ?>
                                        </dd>
                                 <dt><?= __('Mois') ?></dt>                                                                               
                                <dd>
                                    <?= $this->Number->format($vacation->mois) ?>
                                </dd>
                                   <dt><?= __('Annee') ?></dt>                                                                             
                                <dd>
                                    <?= h($vacation->annee) ?>
                                </dd>
                                   <dt><?= __('NbHeure') ?></dt>                                                                             
                                <dd>
                                    <?= $this->Number->format($vacation->nbHeure) ?>
                                </dd>
                                   <dt><?= __('DateInsertion') ?></dt>                                                             
                                                                                                        
                                <dd>
                                    <?= h($vacation->dateInsertion) ?>
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

</section>
