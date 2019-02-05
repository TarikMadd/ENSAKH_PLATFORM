<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerActivites'], ['escape' => false])?>
    </li>
</ol>
<div class="fonctionnairesActivites form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesActivite) ?>
    <fieldset>
        <legend><?= __('Add Fonctionnaires Activites') ?></legend>
        <?php

        echo $this->Form->input('somme', ['options' => $sommetab]);
        echo $this->Form->input('nomActivite', ['options' => $nomtab]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>