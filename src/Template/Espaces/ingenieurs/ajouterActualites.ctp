<section class="content-header">
  <h1>
    Actualité
    <small><?= __('') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'index'], ['escape' => false]) ?>
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
          <h3 class="box-title"><?= __('Ajouter') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($actualite, array('type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('titre',array('label'=>'Titre'));
            echo $this->Form->input('texte',array('label'=>'Texte'));
            echo $this->Form->input('date',array('label'=>'Date'));
           echo $this->Form->input('photo', array('type' => 'file','label'=>'Photo'));
           echo $this->Form->input('file', array('type' => 'file','label'=>'Fichier'));
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
