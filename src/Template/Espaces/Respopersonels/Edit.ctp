<ol class="breadcrumb" >
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerProfsParDepar'], ['escape' => false])?>
    </li>
  </ol>
<center><div class="panel panel-primary"  style="width:500px;margin-left:8px"  class="professeursDepartements form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanentsDepartement) ?>
    <fieldset class="panel-heading">
        <legend><?= __('Modification des professeurs    ') ?></legend>
        <?php
            echo $this->Form->input('Date_Debut');
            echo $this->Form->input('Poste_Filiere');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Update')) ?>
    <?= $this->Form->end() ?>
</div></center>