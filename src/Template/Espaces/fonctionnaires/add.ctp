<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fonctionnaires'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activites'), ['controller' => 'Activites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activite'), ['controller' => 'Activites', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grades'), ['controller' => 'Grades', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grade'), ['controller' => 'Grades', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fonctionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnaire) ?>
    <fieldset>
        <legend><?= __('Add Fonctionnaire') ?></legend>
        <?php
            echo $this->Form->control('somme');
            echo $this->Form->control('date_Recrut');
            echo $this->Form->control('salaire');
            echo $this->Form->control('etat');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('nom_fct');
            echo $this->Form->control('prenom_fct');
            echo $this->Form->control('dateNaissance');
            echo $this->Form->control('lieuNaissance');
            echo $this->Form->control('specialite');
            echo $this->Form->control('situation_Familiale');
            echo $this->Form->control('email');
            echo $this->Form->control('etat_attestation');
            echo $this->Form->control('etat_fiche');
            echo $this->Form->control('phone');
            echo $this->Form->control('CIN');
            echo $this->Form->control('age');
            echo $this->Form->control('genre');
            echo $this->Form->control('nbr_enfants');
            echo $this->Form->control('isPassExam');
            echo $this->Form->control('photo');
            echo $this->Form->control('activites._ids', ['options' => $activites]);
            echo $this->Form->control('grades._ids', ['options' => $grades]);
            echo $this->Form->control('services._ids', ['options' => $services]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
