<section class="content-header">
  <h1>
    Courrier Départ
    <small><?= __('Rechercher') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'indexDepart1'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

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
           
         <form method="post" action="filterDepart">
               

         <div class="col-md-6">       
        
        <div class="form-group">
         <h4><b> Nom Complet du destinataire :</b></h4>
            <select  type="text" name="cat4" class="form-control select2"   >
             <option disabled selected value></option>
             <?php for($i=0;$i<count($destinataires);$i++): ?> 
              <?php echo'<option value="'.$destinataires[$i]['nomComplet_destinataire'].'">'.$destinataires[$i]['nomComplet_destinataire'].'</option>'; ?>
            <?php endfor; ?>

                          </select>
                          </div>

                          <div class="form-group">
      
         <h4><b> Service : </b></h4>
        
         <input type="text" class="form-control" placeholder="Recherche selon le Service"  name="cat6" >  
                  </div>
        <div class="form-group">
        <h4><b> Désignation : </b></h4>
        <input type="text" class="form-control" placeholder="Rechercher selon désignation "  name="cat3" >
        </div>
         <div class="form-group">
       <h4><b > Nécessité d'accusé:</b></h4>
            <select  type="text" name="cat8" class="form-control select2"  style="width: 100%;">
             <option disabled selected value></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
            </div>
        
          
        </div>
        <div class="col-md-6">
        <div class="form-group">

        
      <h4><b> Date départ : </b></h4> 
	  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
	  
	  
        <input type="date" class="form-control" placeholder="Rechercher selon la date de depart "  name="cat2" >
        </div>
		</div>
        
        
      <div class="form-group">
          <h4><b>Etat du courrier</b></h4>
            <select  type="text" name="cat7" class="form-control select2"  style="width: 100%;" >
             <option disabled selected value></option>
              <option value="en attente">en attente</option>
              <option value="-">*</option>
              <option value="courrier reçus">courrier reçu</option>
              <option value="courrier non reçus">courrier non reçus</option>
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
       
        
      </div>
	  
	 
    
      <div class="pull-right">
           <?= $this->Form->button(__('Valider')) ?>
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
