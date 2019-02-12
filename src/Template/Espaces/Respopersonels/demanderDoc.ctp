<section class="content-header">
<ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li><br>
  </ol>


</section><br><br>
<?php
$i=1;
$j=1;
  foreach($doc as $ligne)
  {
    $tab[$i]=$ligne->nomDocument;
    $i++;
  }
  ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
        <div class="panel panel-primary">
     <div class="panel-heading"> - Déposer vos demandes : <div>


        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($documentsProfesseur, array('role' => 'form')) ?>
          <div class="box-body">
          <?php?>
          <div style='width:300px'>  <?php echo $this->Form->input('nomDoc', ['options' => $tab,'label'=>'NOM DOCUMENT :']);?></div>

          </div>
          <!-- /.box-body -->

            <?= $this->Form->button(__('Déposer Demande')) ?>

        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
