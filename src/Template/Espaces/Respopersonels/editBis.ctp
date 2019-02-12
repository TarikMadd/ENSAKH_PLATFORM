

<ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerAbsencesFonctionnaires'], ['escape' => false])?>
    </li>
  </ol>
<div class="professeursDepartements form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnaireAbsnce) ?>
    <fieldset>
        <legend><?= __('Edit Fonctionnaires Absence') ?></legend>
        <?php
            echo $this->Form->input('nom_fct');
            echo $this->Form->input('nbr_absence');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Update')) ?>
    <?= $this->Form->end() ?>
</div>