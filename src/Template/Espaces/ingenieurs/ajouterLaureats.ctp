<section class="content-header">
  <h1>
    Statistique
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
        <?= $this->Form->create($laureat, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('annee',array('label'=>"Promotion "));
            echo $this->Form->input('nombresTravailles',array('label'=>"Nombre des lauréats qui ont décroché un travail"));
            echo $this->Form->input('nombresNonTravailles',array('label'=>"Nombre des lauréats qui sont en chômage"));
            echo $this->Form->input('filieres',array('label'=>"Filière"));
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
