<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Evenement
    <small><?= __('') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'afficherEvenements'], ['escape' => false]) ?>
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
          <h3 class="box-title"><?= __('Modifier') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($evenement, array('type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('titre',array('label'=>'Titre' ));
            echo $this->Form->input('date',array('label'=>'Date'));
            echo $this->Form->input('adresse',array('label'=>'adresse'));
            echo $this->Form->input('tele',array('label'=>"Téléphone"));
            echo $this->Form->input('texte',array('label'=>'Texte'));
            echo $this->Form->input('website',array('label'=>'Site web'));
            echo $this->Form->input('membre',array('label'=>"Nombre de membres du comité"));
            echo $this->Form->input('invite',array('label'=>"NNombre des invités"));
            echo $this->Form->input('photo',array('type'=>'file','label'=>"Photo"));
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
