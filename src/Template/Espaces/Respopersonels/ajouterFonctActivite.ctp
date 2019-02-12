<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerActivites'], ['escape' => false])?>
    </li>
</ol>
<div class="fonctionnairesActivites form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesActivite) ?>
    <fieldset>
        <legend><?= __('Ajouter une activité à un fonctionnaire') ?></legend>
        <?php

        echo $this->Form->input('somme', ['options' => $sommetab]);
        echo $this->Form->input('nomActivite', ['options' => $nomtab]);
        echo $this->Form->input('Poste');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>