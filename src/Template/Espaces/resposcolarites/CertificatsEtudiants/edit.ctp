<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Certificats Etudiant
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'indexCertificatsEtudiants'], ['escape' => false]) ?>
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
        <?php if($certificatEtat[0]['etat'] == "Demande envoyé"){
        $this->Form->create($certificatsEtudiant, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('etat', array('value'=>'En cours de traitement', 'readonly'=>'readonly'));
             
          ?>
            <?= $this->Form->end() ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')); }?>
            <!-- *********************************************************** -->
            <?php if($certificatEtat[0]['etat'] == "En cours de traitement"){
        $this->Form->create($certificatsEtudiant, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('etat', array('value'=>'  Prête', 'readonly'=>'readonly'));
             
          ?>
            <?= $this->Form->end() ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')); }?>
              <!-- *********************************************************** -->
            <?php if($certificatEtat[0]['etat'] == "Prête"){
        $this->Form->create($certificatsEtudiant, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('etat', array('value'=>'Délivré', 'readonly'=>'readonly'));
             
          ?>
            <?= $this->Form->end() ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')); }?>

      
      </div>
    </div>
  </div>
</section>

              