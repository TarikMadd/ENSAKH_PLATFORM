



<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerMouvement'], ['escape' => false])?>
    </li>
</ol>

<div class="fonctionnairesServices form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesService) ?>
    <fieldset>
        <legend><?= __('Affectation des fonctionnaires') ?></legend>
        <?php

        echo $this->Form->input('somme', ['options' => $sommetab]);
        echo $this->Form->input('nom_service', ['options' => $nomtab]);



        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
