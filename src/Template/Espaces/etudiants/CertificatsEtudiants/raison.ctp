      <?php $options = array('3' => 'Convention de stage','4'=>'Recommendation de stage'); ?>
      <form action="<?= $this->Url->build(); ?>" method="POST">
      <br><textarea name="raison" class="textarea wysihtml5-editor" placeholder="Entrez les raisons du retrait" rows=10 cols=100 ></textarea><br>
      <select class="btn btn-default dropdown-toggle" name="demande_certif_choix"  required>
       <?php foreach ($optionsCertificats as  $option):?>
      <option value="<?=$option->id?>"><?=$option->type;?></option>
      <?php endforeach; ?>
      </select>
      <input id="buttonDemandeRetrait" class="btn btn-block btn-primary btn-lg" style="display: inline-block;width:auto;margin-left: 5%;padding: 5px 10px;" 
      name="demande_retrait" value="Demander" type="submit">
      </form>  