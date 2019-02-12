<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerFonctGrade'], ['escape' => false])?>
    </li>
</ol>
<?php $profpermanentsGrade; ?>
 <section class="content">
    <center>
        <div class="panel panel-primary" style="width:800px">
            <div class="panel-heading">

                <div class="row">
                    <h3 class="panel-title"><i class="fa fa-fw fa-info-circle"></i>Affecter un grade à un fonctionnaire</h3>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-6">
<center>
        <?= $this->Form->create() ?>
        <fieldset>
            <?php echo $this->Html->script('remplirCombox.js');?>
            
             <label >Nom et Prenom Professeur</label><br />
              <select style='color:black;height:35px;width:460px' name="idProf">
              <?php foreach($queryProf as $prof): ?>
              <option value=<?= $prof->id ?>><?= $prof->nom_fct.' '.$prof->prenom_fct ?></option>
              <?php endforeach; ?>
              </select>
              
              <?php
              $aidetech = ['1'=>'1er grade', '2eme grade','3eme grade','4eme grade'];
            echo $this->Form->control('categorie', ['options' => $nomtab,'label'=>'CATEGORIE','style'=>'width:460px','placeholder'=> "Choisissez la Catégorie"]);
            echo $this->Form->control('grade', ['options'=>$aidetech,'label'=>'GRADE','style'=>'width:460px']);
            echo $this->Form->control('echelon', ['options' => $tabechelon,'label'=>'ECHELON','style'=>'width:460px']);
            ?>
            


            <label style='margin-left:10px'>Date De Prise :</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="box-body">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input style="width:410px" name="date_grade"type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
</center>
                    </div>
                </div>
            </div>
        </div>
    </center>
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
    $(document).ready(function () {
    $("#categorie").change(function () {
        var val = $(this).val();
        
        switch(val) {
        case '0'://Aide Technicien
          $("#grade").html("<option value='1'>1er grade</option><option value='2'>2eme grade</option>\
          <option value='3'>3eme grade</option><option value='4'>4eme grade</option>");
          break;
        case '1'://Technicien
        $("#grade").html("<option value='1'>1er grade</option><option value='2'>2eme grade</option>\
          <option value='3'>3eme grade</option><option value='4'>4eme grade</option>");
          break;
          case '2'://Aide Administrateur
          $("#grade").html("<option value='1'>1er grade</option><option value='2'>2eme grade</option>\
          <option value='3'>3eme grade</option>");
          break;
          case '3'://Administrateur
          $("#grade").html("<option value='1'>1er grade</option><option value='2'>2eme grade</option>\
          <option value='3'>3eme grade</option>");
          break;
          case '4'://Ingenieur Etat
          $("#grade").html("<option value='1'>1er grade</option>");
          break;
          case 5:
          // code block
          break;
          case 6:
          // code block
          break;
          case '7'://Ing Etat Principal
          $("#grade").html("<option value='2'>2eme grade</option>");
          break;
          case '8'://Ing en chef
          $("#grade").html("<option value='1'>HE</option>");
          break;
        default:
      }

    });
});

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

