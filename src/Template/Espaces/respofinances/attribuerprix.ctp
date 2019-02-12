<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Prix Des Articles 
    <small><?= __('attribution') ?></small>
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
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Article') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($articleevent, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('desigantion',array('disabled' => 'disabled','label' => 'Désignation'));
            echo $this->Form->input('quantite',array('disabled' => 'disabled','label' => 'Quantité'));
            echo $this->Form->input('prix_unitaire_ht',['label' => 'Prix Unitaire Ht']);
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
