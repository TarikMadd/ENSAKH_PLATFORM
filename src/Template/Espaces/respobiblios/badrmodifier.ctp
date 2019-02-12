<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Modifier Ouvrage
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
          <h3 class="box-title"><i class="glyphicon glyphicon-info-sign"></i><?= __('Modification') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($book, array('type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('titre');
            echo $this->Form->input('auteur');
            echo $this->Form->input('edition');
            echo $this->Form->input('resumer');
            echo $this->Form->input('ISBN');
            echo $this->Form->input('numInventaire');
            echo $this->Form->input('sous_categorie_id', ['options' => $sousCategories]);
            //echo $this->Form->input('users._ids', ['options' => $users,'type' => 'hidden']);
            echo $this->Form->input('image', ['type' => 'file']);
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Enregistrer')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
