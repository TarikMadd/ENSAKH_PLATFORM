<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Ajouter Heure Sup </h3>

        </div>
        <?= $this->Form->create($supheure) ?>
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
                        <label for="exampleInputEmail1">Année</label>
                        <input type="number" name="annee" class="form-control" id="annee" value="<?php echo date('Y'); ?>" placeholder="Enter annee" min="2016">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nbr Heures</label>
                        <input type="number" name="nbHeure" class="form-control" id="nbHeure" placeholder="Enter nombre d'heures" min="1" max="20" required>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Professeur </label>
                        <select class="form-control select2" name="profpermanent_id" style="width: 100%;" required>
                            <?php
                            foreach($professeurs as $professeur){
                                echo "<option value ='$professeur->id'>".$professeur->nom_prof." ".$professeur->prenom_prof."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" >
                        <label>Etat</label>
                        <?php
                        echo  "<select name=\"etat\" id='etat' class=\"form-control\" >
                            <option value='validé'>validé</option>						  
						  <option value='non validé'>non validé</option>
						  					 
					     <select>"; ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="box-footer" style="text-align: center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <button type="reset" class="btn btn-default">Effacer</button>
        </div>

        <?= $this->Form->end() ?>
    </div>
</section>
<?php
$this->Html->css([
    'AdminLTE./plugins/select2/select2.min',
],
    ['block' => 'css']);

$this->Html->script([
    'AdminLTE./plugins/select2/select2.full.min',

],
    ['block' => 'script']);
?>
<?php $this->start('scriptBotton'); ?>
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
</script>
<?php $this->end(); ?>
