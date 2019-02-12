<section class="content-header">
<ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'afficherEvent'], ['escape' => false]) ?>
    </li>
  </ol>
  <h1 >

    <small><?= __('') ?></small>
  </h1>

</section>

<!-- Main content -->
<section class="content" class="panel panel-primary"style='width:600px' >
  <div class="row" >
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div  class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ajoutez vos Activités : </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($activite, array('role' => 'form','enctype'=>'multipart/form-data')) ?>
          <div class="box-body" class="panel-heading"  >

           <div  style="width:500px;margin-left:8px" > <?php echo $this->Form->input('nomActivite',['label'=>'Nom Activité','style'=>'width:300px','class'=>'form-control']);?></div>
            <div class="row" >
                                           <div class="col-md-6" >
                                                <div class="box-body">
                                                 <!-- Date dd/mm/yyyy -->
                                                 <div  class="form-group">
                                                   <label >Date Début de l'événement:</label>
                                                     <div class="input-group">
                                                     <div class="input-group-addon">
                                                       <i class="fa fa-calendar"></i>
                                                     </div>
                                                     <input name="dateDebut" style='width:260px' type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                                   </div>
                                                     </div>
                                               </div>
                                            </div>
                                         </div>
                                         <div class="row">
                                                                                    <div class="col-md-6">
                                                                                         <div class="box-body">
                                                                                          <!-- Date dd/mm/yyyy -->
                                                                                          <div     class="form-group">
                                                                                            <label>Date Fin de l'événement :</label>
                                                                                              <div class="input-group">
                                                                                              <div class="input-group-addon">
                                                                                                <i class="fa fa-calendar"></i>
                                                                                              </div>
                                                                                              <input name="dateFin" style='width:260px' type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                                                                            </div>
                                                                                              </div>
                                                                                        </div>
                                                                                     </div>
                                                                                  </div>




          </div>


                                 <div  style="width:500px;margin-left:20px" > <label>Photo Descriptive : </label><input type="file" style='width:300px'  name="photoAct" class="form-control"></div>
          <div class="box-footer" style='margin-left:450px'>
                   <?= $this->Form->button(__('Ajouter')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
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
<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
<?php $this->end(); ?>
