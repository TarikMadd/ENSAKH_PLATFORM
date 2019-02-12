<section class="content-header">
    <h1>
        Ajouter un Evénement
        <small><?= __('') ?></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'afficherFonctEvent'], ['escape' => false]) ?>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($activite, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('nomActivite',['type' => 'text']);
                    echo $this->Form->input('dateDebut');
                    echo $this->Form->input('dateFin');
                    echo $this->Form->input('poste_comite');
                    ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Save')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
