<?php
/**
  * @var \App\View\AppView $this
  */
?>


<div class="fournisseurs index large-9 medium-8 columns content">
    <h3><?= __('l\'etudiant recherché') ?></h3>
    <table cellpadding="0" cellspacing="0">
        
           
   
        <form method="post" action="exportEtudiants">
                <h4>entrer le nom de l'etudiant :<h4><input type="text" name="cat"> 
                <input type="submit" name="afficher" value="Rechercher">
            </form>

            
    </table>
 
</div>