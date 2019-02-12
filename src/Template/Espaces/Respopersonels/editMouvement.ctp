<ol class="breadcrumb">
    <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'mouvementService'], ['escape' => false])?>
    </li>
</ol>
<div class="Mouvement form large-9 medium-8 columns content">
    <?= $this->Form->create($fonctionnairesService) ?>
    <fieldset>
        <legend><?= __('Modifier la date de début d\'un fonctionnaire dans un service') ?></legend>
        <div class="Activite" class="form-group" style="text-align: left">
            <label >Date Début:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input name="date_debut" type="text" class="form-control"placeholder="yyyy-mm-dd hh:mm:ss" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
            </div>
        </div>
        <br>
        <?= $this->Form->button(__('Update')) ?>
        <?= $this->Form->end() ?>
    </fieldset>

</div>



