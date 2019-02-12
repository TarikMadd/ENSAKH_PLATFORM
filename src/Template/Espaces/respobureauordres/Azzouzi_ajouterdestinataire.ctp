<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="destinataires form large-9 medium-8 columns content">
    <?= $this->Form->create($destinataire) ?>
    <fieldset>
        <legend><?= __('Add Destinataire') ?></legend>
        <?php
            echo $this->Form->input('nomComplet_destinataire');
            echo $this->Form->input('adresse_destinataire');
            echo $this->Form->input('email_destinataire');
            echo $this->Form->input('telephone_destinataire');
            echo $this->Form->input('service_destinataire');
          
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
