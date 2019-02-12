<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Courrier Depart
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($courrierDepart, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('date_depart');
            echo $this->Form->input('objet_depart');
            echo $this->Form->input('service_depart');
            echo $this->Form->input('expediteur_id', ['options' => $expediteurs]);
            echo $this->Form->input('type_courrier');
            echo $this->Form->input('chemin_courier');
            echo $this->Form->input('chemin_accuse');
            echo $this->Form->input('destinataires._ids', ['options' => $destinataires]);
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
