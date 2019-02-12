<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Concour
    <small><?= __('Lancer') ?></small>
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
        <?= $this->Form->create($concour, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->hidden('niveaus_id', ['options' => $niveaus, 'empty' => true]);
            echo $this->Form->hidden('filiere_id', ['options' => $filieres, 'empty' => true]);
            echo $this->Form->hidden('etat',['value' => 1]);
            echo $this->Form->input('date_debut', ['empty' => true, 'default' => '']);
            echo $this->Form->input('date_fin', ['empty' => true, 'default' => '']);
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Lancer')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
