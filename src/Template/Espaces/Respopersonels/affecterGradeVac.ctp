<ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerGrade'], ['escape' => false])?>
    </li>
  </ol>

  <center><div class="panel panel-primary"  style="width:500px;margin-left:8px"  class="profpermanentsGrades form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanentsGrade) ?>
    <fieldset>
        <legend><?= __('Affectation des grades :') ?></legend>
        <?php echo $this->Html->script('remplirCombox.js');?>

           <label >Nom et Prenom Professeur</label><br />
              <select style='color:black;height:35px;width:460px' name="idProf">
              <?php foreach($queryProf as $prof): ?>
              <option value=<?= $prof->id ?>><?= $prof->nom_vacataire.' '.$prof->prenom_vacataire ?></option>
              <?php endforeach; ?>
              </select>

            <?php
            $nomtab=['Choisissez le grade convenable','Professeur d\'Enseignement Supérieur','Professeur Habilité','Professeur Assistant'];
            echo $this->Form->control('grade', ['options' => $nomtab,'label'=>'Grade','style'=>'width:460px','placeholder'=> "Choisissez le Grade",'onchange'=>"populate('grade','sousgrade')"]);
             echo $this->Form->control('sousgrade', ['options'=>"",'label'=>'Classe','style'=>'width:460px','onchange'=>"populateBis('sousgrade','echelon','grade')"]);
             echo $this->Form->control('echelon', ['options' => "",'label'=>'Echelon','style'=>'width:460px']);?>
             <label style='margin-left:10px'>Date De Prise :</label>
            <div style="width:410px">
            <div class="row">
                    <div class="col-md-6">
                         <div class="box-body">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">

                              <div class="input-group">
                              <div class="input-group-addon">

                                <i class="fa fa-calendar"></i>
                              </div>

                              <input style="width:410px" name="date_grade"type="text" class="form-control"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>
                              </div></div>
                        </div>
                     </div>
                  </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div></center>
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

