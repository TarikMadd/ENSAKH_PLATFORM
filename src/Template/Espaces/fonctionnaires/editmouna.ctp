<?php
/**
  * @var \App\View\AppView $this
  */
?>
<!-- Mouna JEllouli -->

<section class="content-header">
  <h1>
    Fonctionnaire
 
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
          <div class="fonctionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanent) ?>
    <fieldset>
        <legend><?= __('Edit Fonctionnaire') ?></legend>
        <?php
            echo $this->Form->control('somme');
            //echo $this->Form->control('etat');
            echo $this->Form->control('nom_fct');
            echo $this->Form->control('prenom_fct');
            echo $this->Form->control('dateNaissance');
            echo $this->Form->control('lieuNaissance');
            echo $this->Form->control('specialite');
            echo $this->Form->control('situation_Familiale');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('CIN');
            echo $this->Form->control('age');
            echo $this->Form->control('genre', ['options' => ['male' => 'male', 'femelle' => 'femelle']]);
            echo $this->Form->control('nbr_enfants');
            echo $this->Form->control('isPassExam');
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
        <!-- end -->
      
</div>
    </div>
  </div>
</section>
