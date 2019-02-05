      <section style="width: 50%;">
      <div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Informations'); ?></h3>
            </div>
      <?php $options = array('3' => 'Convention de stage','4'=>'Recommendation de stage'); ?>
            <div class="box-body">
                  <div class="dl-horizontal">
                        <form action="<?= $this->Url->build(); ?>" method="POST">
                        <dl>
                        <dt>Type:</dt>
                        <dd>
                        <select id="type" class="btn btn-default dropdown-toggle" name="demande_certif_choix"  required>
                        <?php foreach ($optionsCertificats as  $option):?>
                        <option value="<?=$option->id?>"><?=$option->type;?></option>
                        <?php endforeach; ?>
                        </select></dd>
                        <br/><dt>Entreprise:</dt><dd><input class="btn btn-default dropdown-toggle" type="text" name="entreprise" required> </dd> 
                        <br/>
                        <dt>Date de debut:</dt> <dd><input class="btn btn-default dropdown-toggle" type="date" name="date_debut"></dd>
                        <br/> <dt>Date de fin:</dt> 
                        <dd><input  class="btn btn-default dropdown-toggle" type="date" name="date_fin"></dd>
                        <br/>
                        <fieldset id="convention">
                        <legend> Informations suplemantaire </legend>
                        <dt>Encadrant:</dt> 
                        <dd>
                        <select class="btn btn-default dropdown-toggle" name="profEncadrant"  required>
                        <?php foreach ($encadrant as  $value):?>
                        <option value="<?=$value->id?>"><?=$value->nom_prof.' '.$value->prenom_prof;?></option>
                        <?php endforeach; ?>
                        </select></dd><br/>
                        <dt>Theme:</dt><dd><input class="btn btn-default dropdown-toggle" type="text" name="theme"></dd>
                        </fieldset>
                        <input id="buttonDemandeStage" class="btn btn-block btn-primary btn-lg pull-right" style="display: inline-block;width:auto;margin-left: 5%;padding: 5px 10px;" 
                        name="demande_certif_stage" value="Demander" type="submit">
                        </form>  
                  </div>
            </div>
            </section>
 <?php $this->start('scriptBotton'); ?>
 <script type="text/javascript">
  $("#type").change(function(){
       if(  $("#type option:selected").text() == "Convention - stage"){
      $("#convention").show();
}else{
      $("#convention").hide();
}
 });
</script>
 <?php $this->end(); ?>