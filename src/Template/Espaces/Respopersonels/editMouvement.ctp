<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'mouvementService'], ['escape' => false])?>
    </li>
</ol>
<div class="Mouvement form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesService) ?>
    <fieldset>
        <legend><?= __('Modifier la date de début d\'un fonctionnaire dans un service') ?></legend>
        <?= $this->Form->control(date_debut)?>
        <br>
        <?= $this->Form->button(__('Modifier')) ?>
        <?= $this->Form->end() ?>
    </fieldset>

</div>



