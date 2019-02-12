<section class="content-header">
  <h1>
    Certificat
   
  </h1>
 
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Ajouter certificat') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($certificat, array('role' => 'form')) ?>
          <div class="box-body">
        
           
      <?php echo $this->Form->input('type'); ?>

            <?php  echo $this->Form->input('nombre_max', array(
  'type' => 'number',
  'min' => 0));
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
