 <!-- SELECT2 EXAMPLE -->
 <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Importation du courrier</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
        <!-- /.box-header -->
        <?= $this->Form->create($courrierArrivee,  ['type' => 'file']) ?>
        <div class="box-body">
          <div class="row">

          <div class="col-md-6">
          <div class="form-group">
                <label>Ancien Expéditeur</label> <br/>
                <select class="form-control select2" style="width: 100%;" name="expediteur_id">
                  <?php for($i=0;$i<count($donne_demande);$i++): ?>
                  <option value="<?=h($donne_demande[$i]['id'])?>"><?=h($donne_demande[$i]['nomComplet_expediteur'])?></option>
                  <?php endfor; ?>
                </select> 
                </div>
                <div class="pull-left">
                <label>Nouveau Expéditeur</label> <br/>
                <?= $this->Html->link(__('Ajouter Expéditeur'), ['action' => 'ajouterexp'], ['class'=>'btn btn-block btn-primary']) ?>
                </div>
                </div>

            <div class="col-md-6">

            
                <div class="form-group">
                <label>Importation du courrier</label>
                <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachement1" value="attachement1">
                </div>
                 <span class="help-block">Max. 8MB</span>
              </div>
              </div>
              <div class="form-group">
                <label>Importation de l'accusé de réception</label>
                <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachement2" value="attachement2">
                </div>
                <span class="help-block">Max. 8MB</span>
              </div>
              </div>

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        </div>

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Informations du courrier</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label>Type du courrier</label>
              <div class="radio">
                    <label>
                      <input type="radio" name="type_courrier" id="optionsRadios1" value="courrier interne" checked>
                      courrier interne
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="type_courrier" id="optionsRadios2" value="courrier externe">
                     courrier externe
                    </label>
                  </div>
                  
              </div>
              <div class="form-group">
               <?php echo $this->Form->input('Désignation'); ?>
              </div>
              
              <!-- /.form-group -->
              
              <label>Date d'arrivée</label>    
              <span class="input-group">                   
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>  
                </span>
                <input type="text" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" name="date_arrivee" value="<?php echo date("Y/m/d"); ?>" >
                
              </span>
              <!-- /.form-group -->

              
               
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        </div>
              <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Nécessité du Traitement ?</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          
          </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Est-ce que le courrier nécessite le traitement ?</label> <br/>
                <input id="show" type="radio" name="necessité_du_traitement" value="Oui" checked="checked" > Oui<br>
                <input id="hide" type="radio"  name="necessité_du_traitement" value="Non"> Non<br>
              </div>
              <div class="form-group">
                <label>Est-ce que le courrier est retourné ?</label> <br/>
                <input id="hide" type="radio" name="courrier_retourne" value="Oui"  > Oui<br>
                <input id="show" type="radio"  name="courrier_retourne" value="Non" checked="checked"> Non<br>
              </div>
              <hada>
             
              <label>Service traitant</label>
                  <?php echo '<select name="service_id" style="width: 100%; height:40px;" class="form-control select2"  required="false">'; ?>
                    
                    <?php foreach($services as $service)
                        {
                          echo '<option value="'.$service['id'].'" style="width: 100%;" >' .$service['nom'] . '</option>';
                        }
                  echo '</select>';?> <br/>
        
          <label > Priorité</label><br/>
            <select  type="text" name="Priorité" class="form-control select2"  style="width: 100%;" value="aucun">
             
              <option value="Normal">Normal</option>
              <option value="Urgent">Urgent</option>
              <option value="Très urgent">Très urgent</option>
            </select>
            
         
              
         
 
          
         <label>Date limite du traitement</label>    
              <span class="input-group">                   
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>  
                </span>
                <input type="text" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" name="date_limite_du_traitement" value="<?php echo date("Y/m/d"); ?>">
                
              </span>
              
                <!-- /.input group -->
              
                
             
              </hada>  
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        </div>
        <div class="box-footer">
            <?= $this->Form->button(__('enregistrer')) ?>
          </div>
    

           <!-- /.box-body -->
          
        <?= $this->Form->end() ?>
</section>







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
            $("#hide").click(function(){
            $("hada").hide();
            });
            $("#show").click(function(){
            $("hada").show();
            });
            });
</script>
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


