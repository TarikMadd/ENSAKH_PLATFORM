<?php
/**
  * @var \App\View\AppView $this
  */
?>



<div class="expediteurs index large-9 medium-8 columns content">
    <h3><?= __('Liste des Destinataires	par id') ?></h3>
    <table cellpadding="0" cellspacing="0">
        
           
   
        <form method="post" action="Azzouzi_filterdest">
                <h4> Filtrer selon :<h4>
				<select name="omaima">
				<option value="id"> ID </option>
				<option value="nom_expediteur"> nom Complet de destinataire </option>
				<option value="adresse"> Adresse </option>
				<option value="service"> service </option>
				<option value="email"> email </option>
				<option value="telephone"> telephone </option>
				
				
				</select>
				
				<input type="text" class="form-control" placeholder="Entrer votre choix "  name="cat" ><br>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
				
				
            </form>

            
    </table>
 
</div>