<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vacatairesbi->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vacatairesbi->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vacatairesbis'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vacatairesbis form large-9 medium-8 columns content">
    <?= $this->Form->create($vacatairesbi) ?>
    <fieldset>
        <legend><?= __('Edit Vacatairesbi') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('somme');
            echo $this->Form->control('nom_vacataire');
            echo $this->Form->control('prenom_vacataire');
            echo $this->Form->control('nb_heures');
            echo $this->Form->control('echelle');
            echo $this->Form->control('echelon');
            echo $this->Form->control('dateRecrut');
            echo $this->Form->control('dateNaissance');
            echo $this->Form->control('LieuNaissance');
            echo $this->Form->control('diplome');
            echo $this->Form->control('universite');
            echo $this->Form->control('specialite');
            echo $this->Form->control('CIN');
            echo $this->Form->control('situationFamiliale');
            echo $this->Form->control('codeSituation');
            echo $this->Form->control('dateAffectation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
