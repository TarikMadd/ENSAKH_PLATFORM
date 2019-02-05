
<?php
/**
 * @var \App\View\AppView $this
 */
?>



<div class="fonctionnaires index large-9 medium-8 columns content">

    <table cellpadding="0" cellspacing="0">



        <form method="post" action="filterfoncBis">
            <h4> Choisir un critère:<h4>
                    <select name="recherche"class="form-control">

                        <option value="nom_fct"> Nom Professeur </option>
                        <option value="prenom_fct"> Prenom Professeur </option>
                        <option value="somme">Numero de somme </option>
                        <option value="specialite"> Specialite </option>
                        <option value="echelle"> Echelle</option>
                        <option value="echelle"> Age</option>
                        <option value="echelle"> Date Recrutement</option>

                    </select>
                    <br>
                    <input type="text" class="form-control" placeholder="Entrer votre choix "  name="cat" ><br>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                    </select>
        </form>


    </table>

</div>