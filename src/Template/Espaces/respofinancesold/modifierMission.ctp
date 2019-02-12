<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Mission
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
        <?= $this->Form->create($mission, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
             echo $this->Form->input('date_depart');
            echo $this->Form->input('date_arrivee');
            echo $this->Form->select('mode_transport', ['voiture personnelle','voiture de service']);
            echo('<br>');
            echo $this->Form->input('nbr_nuit');
            echo $this->Form->hidden('taux');
            echo $this->Form->hidden('indemnite_kilometrique');
            echo $this->Form->input('indemnite_appliquee');
            echo $this->Form->input('etat');
            echo $this->Form->input('total');
            echo $this->Form->input('fonctionnaire_id', ['options' => $fonctionnaires ,'empty' => true]);
            echo $this->Form->input('profpermanent_id', ['options' => $profpermanents,'empty' => true]);
            echo $this->Form->input('ville_id', ['options' => $villes]);
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
