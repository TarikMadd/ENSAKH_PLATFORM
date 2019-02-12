<?php
/**
  * @var \App\View\AppView $this
  */
?>



<div class="CourrierArrivees index large-9 medium-8 columns content">
    <h3><?= __('Rechercher selon : ') ?></h3>
    <table cellpadding="0" cellspacing="0">
	<div class="box box-warning">
                    <div class="box-header with-border">
           
         <form method="post" action="filterArrivee" >
               

         <div class="col-md-6">       
        
        <div class="form-group">
        <h4><b> Numéro d'enregistrement : </b></h4>
        <input type="text" class="form-control" placeholder="Rechercher selon numéro d'enregistrement "  name="cat1" >
         <h4><b> Nom Complet de l'expéditeur :</b></h4>
            <select  type="text" name="cat9" class="form-control select2"   >
             <option disabled selected value></option>
             <?php for($i=0;$i<count($expediteurs);$i++): ?> 
              <?php echo'<option value="'.$expediteurs[$i]['nomComplet_expediteur'].'">'.$expediteurs[$i]['nomComplet_expediteur'].'</option>'; ?>
            <?php endfor; ?>

                          </select>
                          </div>

                          <div class="form-group">
      
         <h4><b> Service Traitant : </b></h4>
        
         
        
                  <?php echo '<select name="cat6" style="width: 100%; height:40px;" class="form-control select2"  >'; ?>
                    <option disabled selected value></option>
                    <?php foreach($services as $ib)
                        {

                          echo '<option value="'.$ib['nom_service'].'" style="width: 100%;" >' .$ib['nom_service'].'</option>';
                        }
                  echo '</select>';?>  
                  </div>
             <div class="form-group">
        
                           <h4>  <b> Date limite de traitement </b></h4>
						   <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
						   
          <input type="date" class="form-control"  placeholder="Recherche selon l'etat du courrier"  name="cat10" >
          </div>
		  </div>
		  
        
        <div class="form-group">
        <h4><b> Désignation : </b></h4>
        <input type="text" class="form-control" placeholder="Rechercher selon désignation "  name="cat3" >
        </div>
         
        <div class="form-group">
       <h4><b > Courrier Retourné:</b></h4>
            <select  type="text" name="cat11" class="form-control select2"  style="width: 100%;">
             <option disabled selected value></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
            </div>
       
          
        </div>
        <div class="col-md-6">
        <div class="form-group">

        
      <h4><b> Date arrivée : </b></h4> 
	  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
	  
	  
        <input type="date" class="form-control" placeholder="Rechercher selon la date d'arrivée "  name="cat2" >
        </div>
		</div>
        <div class="form-group">

        
           <h4><b > Priorité:</b></h4>
            <select  type="text" name="cat7" class="form-control select2"  style="width: 100%;">
             <option disabled selected value></option>
              <option value="Normal">Normal</option>
              <option value="Urgent">Urgent</option>
              <option value="Très urgent">Très urgent</option>
            </select>
            </div>

        
        
      <div class="form-group">
          <h4><b>Etat du courrier</b></h4>
            <select  type="text" name="cat8" class="form-control select2"  style="width: 100%;" >
             <option disabled selected value></option>
              <option value="en attente">en attente</option>
              <option value="en cours de traitement">en cours de traitement</option>
              <option value="traité">traité</option>
              <option value="interrompu">interrompu</option>
            </select>
            </div>
            <div class="form-group">
           <h4><b > Type du courrier:</b></h4>
            <select  type="text" name="cat5" class="form-control select2"  style="width: 100%;">
             <option disabled selected value></option>
              <option value="Interne">Interne</option>
              <option value="Externet">Externe</option>
              
            </select>
            
        </div>

        <div class="form-group">
       <h4><b > Nécessité du traitement:</b></h4>
            <select  type="text" name="cat4" class="form-control select2"  style="width: 100%;">
             <option disabled selected value></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
            </div>
        
      </div>
	  
	 
    
      <div class="pull-right">
           <?= $this->Form->button(__('Exécuter')) ?>
                    <?= $this->Form->end() ?>
               </div>    
                   
       
        
            </div>


        
        
            </form>


            
    </table>
 
</div>
</div>
</div>












<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "jj/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "jj/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

   

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
