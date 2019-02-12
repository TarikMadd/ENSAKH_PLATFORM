<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'afficherFonctEvent'], ['escape' => false])?>
    </li>
</ol>

<div class="FonctionnairesActivites form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesActivite) ?>
    <fieldset>
        <legend><?= __('Affecter un fonctionnaire à un événement') ?></legend>
        <?php

        echo $this->Form->input('somme', ['options' => $tab1]);
        echo $this->Form->input('nomActivite', ['options' => $tab2]);
        echo $this->Form->input('poste_comite');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
