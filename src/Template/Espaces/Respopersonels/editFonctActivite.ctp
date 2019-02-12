<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerActivites'], ['escape' => false])?>
    </li>
</ol>
<div class="Activites Fonctionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesActivite) ?>
    <fieldset>
        <legend><?= __('Modifier les activités des fonctionnaires ') ?></legend>
        <?php

        echo $this->Form->input('poste_comite');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Update')) ?>
    <?= $this->Form->end() ?>
</div>