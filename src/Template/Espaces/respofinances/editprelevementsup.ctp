<?php
/**
  * @var \App\View\AppView $this
  */
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Modifier prélèvement ') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($prelevement, array('role' => 'form')) ?>
          <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Date de debut</label>
                  <div  id="sandbox-container">
                      <div class="input-group date">
                          <input type="text" name="dateDebut" class="form-control" value="<?php echo date_format(date_create($prelevement->dateDebut), 'd/m/Y'); ?>" required>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                      </div>
                  </div>
              </div>


              <div class="form-group">
                  <label for="exampleInputEmail1">Date de debut</label>
                  <div  id="sandbox-container">
                      <div class="input-group date">
                          <input type="text" name="dateFin" class="form-control" value="<?php echo date_format(date_create($prelevement->dateFin), 'd/m/Y'); ?>" required>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" style="text-align: center">
              <button type="submit" class="btn btn-primary">Enregistrer</button>
              <button type="reset" class="btn btn-default">Réinitialiser</button>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
    'AdminLTE./plugins/datepicker/datepicker3',
],
    ['block' => 'css']);

$this->Html->script([
    'AdminLTE./plugins/datatables/jquery.dataTables.min',
    'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
    'AdminLTE./plugins/datepicker/bootstrap-datepicker.js',
],
    ['block' => 'script']);

?>

<?php $this->start('scriptBotton'); ?>
    <script>
        $('#sandbox-container .input-group.date').datepicker({
            format: "dd/mm/yyyy",
            startView: 1,
            todayBtn: "linked",
            language: "fr",
            autoclose: true
        });

    </script>
<?php $this->end(); ?>