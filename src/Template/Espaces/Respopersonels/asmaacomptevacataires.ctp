<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
</nav>
<div class="vacataires form large-9 medium-8 columns content">
    <?= $this->Form->create($vacataire) ?>
    <fieldset>
        <legend><?= __(' creation de compte Vacataire') ?></legend>
        <?php
            echo $this->Form->input('somme');
            echo $this->Form->input('nom_vacataire');
            echo $this->Form->input('prenom_vacataire');
            echo $this->Form->input('nb_heures');
            echo $this->Form->input('echelle');
            echo $this->Form->input('echelon');
            echo $this->Form->input('dateRecrut');
            echo $this->Form->input('dateNaissance');
            echo $this->Form->input('LieuNaissance');
            echo $this->Form->input('diplome');
            echo $this->Form->input('universite');
            echo $this->Form->input('specialite');
            echo $this->Form->input('CIN');
            echo $this->Form->input('situationFamiliale');
            echo $this->Form->input('codeSituation');
            echo $this->Form->input('dateAffectation');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
