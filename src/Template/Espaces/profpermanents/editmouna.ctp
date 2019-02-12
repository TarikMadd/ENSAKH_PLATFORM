<?php
/**
  * @var \App\View\AppView $this
  */
?>
<!-- Mouna JEllouli -->

<section class="content-header">
  <h1>
    Professeur permanent
 
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
        <div class="profpermanents form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanent) ?>
    <fieldset>
        <legend><?= __('veuillez entrer les modifications que vous souhaitez') ?></legend>
        <?php
         echo $this->Form->input('nom_prof');
            echo $this->Form->input('prenom_prof');
              echo $this->Form->input('age');
		 echo $this->Form->input('somme');
            echo $this->Form->input('salaire');
            //echo $this->Form->input('etat');
           echo $this->Form->input('autresdiplomes');
            echo $this->Form->input('diplome');
            echo $this->Form->input('specialite');
            echo $this->Form->input('universite');
            echo $this->Form->input('situation_familiale');
            echo $this->Form->input('Lieu_Naissance');
            echo $this->Form->input('CIN');
            echo $this->Form->input('email_prof');
            echo $this->Form->input('phone');
            echo $this->Form->input('genre', ['options' => ['male' => 'male', 'femelle' => 'femelle']]);


        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
    </div>
  </div>
</section>
