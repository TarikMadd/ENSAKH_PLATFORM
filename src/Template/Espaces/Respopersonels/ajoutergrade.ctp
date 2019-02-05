<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Ajouter une vacation </h3>

        </div>
        <?= $this->Form->create($vacataires_grades) ?>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group" >
                            <label>Grade</label>
                            <?php
                            echo  "<select name=\"grade\" id='grade' class=\"form-control\" required>
                            <option value='1'>Janvier</option>                        
                          <option value='2'>février</option>
                          <option value='3'>Mars</option>
                                       
                         <select>"; ?>
                        </div>
                    </div>


                      </div>
            </div>


      <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nb Heures</label>
                            <input type="number" name="nbHeure" class="form-control" id="nbHeure" placeholder="Enter nombre d'heures" required>
                        </div>

                    </div>
                    












            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        <?= $this->Form->end() ?>
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
