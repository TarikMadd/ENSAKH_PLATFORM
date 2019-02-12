<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'mouvementService'], ['escape' => false])?>
    </li>
</ol>
<div class="fonctionnairesServices form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesService) ?>
    <fieldset>
        <legend><?= __('Ajouter un fonctionnaire à un service ') ?></legend>
        <?php

        echo $this->Form->input('somme', ['options' => $tab1]);
        echo $this->Form->input('nomService', ['options' => $tab2]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>