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
        <?= $this->Form->create($vacation) ?>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group" >
                            <label>Mois</label>
                            <?php
                            echo  "<select name=\"mois\" id='mois' class=\"form-control\" >
                            <option value='1'>Janvier</option>                        
                          <option value='2'>février</option>
                          <option value='3'>Mars</option>
                          <option value='4'>Avril</option>
                          <option value='5'>Mai</option>
                          <option value='6'>Juin</option>
                          <option value='7'>juillet</option>
                          <option value='8'>aout</option>
                          <option value='9'>septembre</option>
                          <option value='10'>octobre</option>
                          <option value='11'>novembre</option>
                          <option value='12'>décembre</option>                       
                         <select>"; ?>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">annee</label>
                            <input type="number" name="annee" class="form-control" id="annee" value="<?php echo date('Y'); ?>" placeholder="Enter annee" min="2016">
                        </div>

                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nb Heure</label>
                            <input type="number" name="nbHeure" class="form-control" id="nbHeure" placeholder="Enter nombre d'heures" min="1">
                        </div>

                    </div>
                    

                   
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

