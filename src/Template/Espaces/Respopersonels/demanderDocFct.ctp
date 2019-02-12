<section class="content-header">
    <h1>
Déposer une demande    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'index'], ['escape' => false]) ?>
        </li>
    </ol>
</section>
<?php
$i=1;
$j=1;
foreach($doc as $ligne)
{
    $tab[$i]=$ligne->nomDocument;
    $i++;
}
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Form') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($documentsFonctionnaire, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('nomDoc', ['options' => $tab]);
                    ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button(__('Lancer Demande')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
