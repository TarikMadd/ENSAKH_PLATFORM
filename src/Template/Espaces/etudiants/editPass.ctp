<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Edition
    <small><?= __('Mot de Passe') ?></small>
  </h1>
</section>
<section class="content-header">
    <div class="alert alert-danger alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-ban"></i> <?= __('Attention') ?>!</h4>
        <?= h('Pour votre confidentialité, Ne communiquez votre Mot de Passe à personne.') ?>
    </div>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($user, array('role' => 'form', 'type' => 'POST'))?>
          <div class="box-body">
          <?php            
            echo $this->Form->input('password',array('label'=>'Nouveau Mot de Passe'));
            
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Valider')) ?>

          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
