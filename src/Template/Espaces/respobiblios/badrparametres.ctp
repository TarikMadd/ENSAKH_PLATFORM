<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Paramètre
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Acceuil'), ['action' => 'index'], ['escape' => false]) ?>
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
          <h3 class="box-title"><i class="glyphicon glyphicon-info-sign"></i><?= __('Information') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($parametre, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('maxProfVac',['label' => 'Maximum des ouvrages empruntés par un professeur vacataire']);
            echo $this->Form->input('maxProfPer',['label' => 'Maximum des ouvrages empruntés par un professeur Permanent']);
            echo $this->Form->input('maxEtud',['label' => 'Maximum des ouvrages empruntés par un étudiant']);
            echo $this->Form->input('dureeEmprunteProf',['label' => "la durée maximale d'emprunte  par un professuer(jours)"]);
            echo $this->Form->input('dureeEmprunteEtud',['label' => "la durée maximale d'emprunte  par un étudiant(jours)"]);
            echo $this->Form->input('dureeReservation',['label' => "la durée maximale d'une résérvation(jours)"]);
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
