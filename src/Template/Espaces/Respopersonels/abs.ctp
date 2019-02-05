<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="absences index large-9 medium-8 columns content">

    <table cellpadding="0" cellspacing="0">
        <form method="post" action="filterabs">
            <h4> Choisir un critère:<h4>
                    <select name="recherche"class="form-control">
                        <option value="id"> Id </option>
						<option value="fonctionnaire_id"> Id Fonctionnaire </option>
                        <option value="duree_ab"> Durée Absence </option>
                        <option value="cause"> Cause Absence </option>
                        <option value="date_ab"> Date Absence </option>
						 <option value="time_ab"> Heure Absence </option>
                  </select>
                    <br>
                    <input type="text" class="form-control" placeholder="Entrer votre choix "  name="cat" ><br>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                    </select>
        </form>
    </table>
    
</div>