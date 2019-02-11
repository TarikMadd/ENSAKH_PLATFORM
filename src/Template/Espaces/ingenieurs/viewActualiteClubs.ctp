<section class="content-header">
  <h1>
    <?php echo __('Parascolaire'); ?>
</h1>
<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'afficherActualiteClubs'], ['escape' => false])?>
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
                            <?= h($actualiteclub->titre) ?>
                        </dd>
                        <dt><?= __('Image') ?></dt>
                        <dd>
                            <?= h($actualiteclub->image) ?>
                        </dd>
                        <dt><?= __('Video') ?></dt>
                        <dd>
                            <?= h($actualiteclub->video) ?>
                        </dd>
                        <dt><?= __('Fichier') ?></dt>
                        <dd>
                            <?= h($actualiteclub->fichier) ?>
                        </dd>


                        <dt><?= __('Club') ?></dt>
                        <dd>

                            <?= h($actualiteclub->nom) ?>
                        </dd>

                        <dt><?= __('Date') ?></dt>
                        <dd>
                            <?= h($actualiteclub->date) ?>
                        </dd>


                        <dt><?= __('Texte') ?></dt>
                        <dd>
                            <?= $this->Text->autoParagraph(h($actualiteclub->texte)); ?>
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
