<section class="content-header">
  <h1>
    Certificat
    <small><?= __('Add') ?></small>
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
          <h3 class="box-title"><?= __('Form') ?></h3>
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
            <?= $this->Form->button(__('Save'),['class'=>'fa fa-save']) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
<script>
  $('#type').change(function() {
  var val = $(this).val();
  if(val.indexOf('-stage') == -1)
    $(this).val(val+'-stage');
});
</script>
