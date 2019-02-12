<section class="content-header">
    <h1>
        <?php echo __('Infos Supplémentaires'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerFonctParService'], ['escape' => false])?>
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
                    <h3 class="box-title"><?php echo __('A propos'); ?></h3>
                </div>
                <!-- /.box-header -->
                <br>
                <div class="box-body">
                    <?php echo $this->Html->image('9.jpg'); ?>
                    <dl class="dl-horizontal">
                        <dt><?= __('Nom:') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->nom_fct) ?>
                        </dd>
                        <dt><?= __('Prénom:') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->prenom_fct) ?>
                        </dd>
                        <dt><?= __('Service:') ?></dt>
                        <dd>
                            <?= h($service->nom_service) ?>
                        </dd>
                        <dt><?= __('Somme:') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->somme) ?>
                        </dd>
                        <dt><?= __('Date Naissance:') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->dateNaissance) ?>
                        </dd>
                        <dt><?= __('Lieu Naissance:') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->lieuNaissance) ?>
                        </dd>
                    </dl>
                </div>
                </div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->

</section>
