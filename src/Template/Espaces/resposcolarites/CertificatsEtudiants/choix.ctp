<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Certificats Etudiant
    <small><?= __('Supprimer') ?></small>
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
          <?php for($i=0;$i<count($certificats_type);$i++): ?>
        <form action="<?= $this->Url->build(); ?>" method="post">
        <div class="box-body">
          <label>
                      <input type="checkbox"  name="<?=h($certificats_type[$i]['id']); ?>"> <?= h($certificats_type[$i]['type']) ?> 
                      
                    </label>
          </div>
           <?php endfor; ?>
          <!-- /.box-body -->
          <div class="box-footer">
            <input type="submit" name="vider" value="Réinitialiser" class="btn btn-danger btn-lg">
          </div>
        </form>
     
      </div>
    </div>
  </div>
</section>
