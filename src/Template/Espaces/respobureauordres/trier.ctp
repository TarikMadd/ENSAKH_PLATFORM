<?php
/**
  * @var \App\View\AppView $this
  */
?>



<div class="CourrierDeparts index large-9 medium-8 columns content">
    <h3><?= __('liste courrier de depart') ?></h3>
    <table cellpadding="0" cellspacing="0">
        
           
   
        <form method="post" action="filter">
                <h4> Filtrer selon :<h4>
				<select name="omaima">
				<option value="id"> ID </option>
				<option value="date_depart"> date de depart </option>
				<<?php /* <option value="objet_arrivee"> objet d'arrivee </option>
				<option value="service_arrivee"> service </option>
				<option value="expediteur_id"> expediteur id </option>
				<option value="type_courrier"> type </option>
				<option value="chemin_courrier"> chemin courrier </option>
				<option value="chemin_accuse"> chemin accuse </option>*/?>
				
				</select>
				
				<input type="text" class="form-control" placeholder="Entrer votre choix "  name="cat" ><br>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
				
				
            </form>

            
    </table>
 
</div>