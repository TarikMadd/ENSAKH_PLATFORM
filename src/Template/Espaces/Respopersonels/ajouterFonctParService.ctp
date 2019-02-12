<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerFonctParService'], ['escape' => false])?>
    </li>
</ol>
<div class="fonctionnairesServices form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesService) ?>
    <fieldset>
        <legend><?= __('Add Fonctionnaires Services ') ?></legend>
        <?php

        echo $this->Form->input('somme', ['options' => $sommetab]);
        echo $this->Form->input('nomService', ['options' => $nomtab]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>