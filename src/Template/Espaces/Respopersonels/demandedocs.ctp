<!--<div class="box-header with-border">
<div class="col-xs-12 col-sm-4 emphasis">


<form   method="post" action=" <?php echo $this->Url->build('/respopersonels/demandedocs', true) ?>">
    <select name="choix" required ></br>
        <option value="attestationTravail">attestationTravail</option>
        <option value="2">2</option>
        
</select></br>
<input type="date" name="date" required></br>
<input type="text" value="<?php echo $id;?>" name="id" disabled></br>
    <button type="submit" class="btn btn-info btn-block">cliquez ici pour envoyer </button></br>
</form>
</div>
</div>-->

<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Ajouter une Demande </h3>

        </div>
        
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
<?= $this->Form->create($vacatairesDocument, array('role' => 'form')) ?>
                    <div class="col-md-12">
                        <div class="form-group" >
                            <label>Demande</label>
                            <?php
                            echo  "<select name=\"choix\" required  class=\"form-control\" >
                            <option value='attestationTravail'>attestationTravail</option>
                            
                                                
                         <select>"; ?>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date</label>
                            <input type="date" name="date" required class="form-control">
                        </div>

                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Numero Somme</label>
                            <input type="text" value="<?php echo $id;?>" name="id" disabled class="form-control">
                        </div>

                    </div>
                    

                   
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-info btn-block">cliquez ici pour envoyer la demande </button>
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





       