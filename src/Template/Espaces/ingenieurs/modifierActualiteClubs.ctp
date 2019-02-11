<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Parascolaire
    <small><?= __('') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'afficherActualiteClubs'], ['escape' => false]) ?>
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
        <?= $this->Form->create($actualiteclub, array('type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('titre',array('label'=>"Titre"));
            echo $this->Form->input('date',array('label'=>"Date"));
            echo $this->Form->input('texte',array('label'=>"Texte"));
            // echo $this->Form->input('id_club',array('label'=>"Club"));
            ?>
            <label>Club</label>
           <select class="form-control select2" style="width: 100%;" name="id_club">
                  <?php for($i=0;$i<count($donne_demande);$i++): ?>
                  <option value="<?=h($donne_demande[$i]['id'])?>" > <?=h($donne_demande[$i]['nom'])?></option>
                  <?php endfor; ?>
                </select> 
            <?php
            
            echo $this->Form->input('photo', array('type' => 'file','label'=>"Photo"));
            echo $this->Form->input('video',array('label'=>"URL de la vidéo "));
            echo $this->Form->input('fichier', array('type' => 'file','label'=>"Fichier"));
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Enregister')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
