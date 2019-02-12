<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Courrier Depart
    <small><?= __('Modifier') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'indexDepart1'], ['escape' => false]) ?>
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
          <h3 class="box-title"><?= __('Formulaire') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($courrierDepart, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('date_depart');
            echo $this->Form->input('désignation');
            ?>
            <label> Destinataire </label>
                  <?php echo '<select name="destinataire_id" style="width: 100%; height:40px;" class="form-control select2" >'; ?>
                 <?php   echo '<option selected value="'.$dest[0]["id"].'" style="width: 100%;" >' .$dest[0]["nomComplet_destinataire"].'</option>' ; ?>
                    <?php foreach($destinataires as $var)
                        {
                          echo '<option value="'.$var['id'].'" style="width: 100%;" >' .$var['nomComplet_destinataire'].'</option>';
                        }
                  echo '</select>';?> <br/>

            <div class="form-group">
              <label>Type du courrier</label>
              <div class="radio">
                    <label>
                      <input type="radio" name="type_courrier" id="optionsRadios1" value="courrier interne" checked>
                      courrier interne
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="type_courrier" id="optionsRadios2" value="courrier externe">
                     courrier externe
                    </label>
                  </div>
                  
              </div>      
            <?php 
            echo $this->Form->input('service');
            ?>
           
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Sauvegarder')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });
</script>
<?php $this->end(); ?>
<?php
$this->Html->css([
    'AdminLTE./plugins/daterangepicker/daterangepicker-bs3',
    'AdminLTE./plugins/iCheck/all',
    'AdminLTE./plugins/colorpicker/bootstrap-colorpicker.min',
    'AdminLTE./plugins/timepicker/bootstrap-timepicker.min',
    'AdminLTE./plugins/select2/select2.min',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/select2/select2.full.min',
  'AdminLTE./plugins/input-mask/jquery.inputmask',
  'AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions',
  'AdminLTE./plugins/input-mask/jquery.inputmask.extensions',
  'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
  'AdminLTE./plugins/daterangepicker/daterangepicker',
  'AdminLTE./plugins/colorpicker/bootstrap-colorpicker.min',
  'AdminLTE./plugins/timepicker/bootstrap-timepicker.min',
  'AdminLTE./plugins/iCheck/icheck.min',
],
['block' => 'script']);
?>
