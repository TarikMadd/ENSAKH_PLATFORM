<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Destinataires'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="destinataires form large-9 medium-8 columns content">
    <?= $this->Form->create($destinataire) ?>
    <fieldset>
        <legend><?= __('Add Destinataire') ?></legend>
        <?php
            echo $this->Form->control('nomComplet_destinataire');
            echo $this->Form->control('adresse_destinataire');
            echo $this->Form->control('email_destinataire');
            echo $this->Form->control('telephone_destinataire');
            echo $this->Form->control('ville_destinataire');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
