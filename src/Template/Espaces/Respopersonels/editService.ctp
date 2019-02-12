<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'listerFonctParService'], ['escape' => false])?>
    </li>
</ol>
<div class="Fonctionnaires Par Service form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesService) ?>
    <fieldset>
        <legend><?= __('Edit Fonctionnaires Services') ?></legend>
        <?php
        echo $this->Form->input('date_debut');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Update')) ?>
    <?= $this->Form->end() ?>
</div>