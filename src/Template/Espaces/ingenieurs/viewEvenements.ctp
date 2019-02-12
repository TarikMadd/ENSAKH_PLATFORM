<section class="content-header">
  <h1>
    <?php echo __('Evenement'); ?>
</h1>
<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'afficherEvenements'], ['escape' => false])?>
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
                        <dt><?= __('Titre') ?></dt>
                        <dd>
                            <?= h($evenement->titre) ?>
                        </dd>
                        <dt><?= __('Adresse') ?></dt>
                        <dd>
                            <?= h($evenement->adresse) ?>
                        </dd>
                        <dt><?= __('Téléphone') ?></dt>
                        <dd>
                            <?= h($evenement->tele) ?>
                        </dd>
                        <dt><?= __('Photo') ?></dt>
                        <dd>
                            <?= h($evenement->photo) ?>
                        </dd>



                        <dt><?= __('Date') ?></dt>
                        <dd>
                            <?= h($evenement->date) ?>
                        </dd>


                        <dt><?= __('Texte') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($evenement->texte)); ?>
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
