<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="paimentvacs view large-9 medium-8 columns content">
    <h3><?= h($paimentvac->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($paimentvac->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etatsomme') ?></th>
            <td><?= h($paimentvac->etatsomme) ?> <?= $this->Html->link(__('etat des somme'), ['action' => 'etatSommesVac', $paimentvac->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordrepaiment') ?></th>
            <td><?= h($paimentvac->ordrepaiment) ?></td>
            <td><?= h($paimentvac->etatsomme) ?> <?= $this->Html->link(__('ordre de paiment'), ['action' => 'opVac', $paimentvac->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('OrdrepaimentRap') ?></th>
            <td><?= h($paimentvac->ordrepaiment) ?></td>
            <td><?= h($paimentvac->etatsomme) ?> <?= $this->Html->link(__('ordre de paiment Rap'), ['action' => 'opVacRap', $paimentvac->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Compte') ?></th>
            <td><?= $paimentvac->has('compte') ? $this->Html->link($paimentvac->compte->id, ['controller' => 'Comptes', 'action' => 'view', $paimentvac->compte->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordrevirment') ?></th>
            <td><?= $paimentvac->has('ordrevirment') ? $this->Html->link($paimentvac->ordrevirment->id, ['controller' => 'Ordrevirments', 'action' => 'view', $paimentvac->ordrevirment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($paimentvac->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datepaiment') ?></th>
            <td><?= h($paimentvac->datepaiment) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Vacations') ?></h4>
        <?php if (!empty($paimentvac->vacations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Mois') ?></th>
                <th scope="col"><?= __('Annee') ?></th>
                <th scope="col"><?= __('NbHeure') ?></th>
                <th scope="col"><?= __('DateInsertion') ?></th>
                <th scope="col"><?= __('Etat') ?></th>
                <th scope="col"><?= __('Vacataire Id') ?></th>
                <th scope="col"><?= __('Paimentvac Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($paimentvac->vacations as $vacations): ?>
            <tr>
                <td><?= h($vacations->id) ?></td>
                <td><?= h($vacations->mois) ?></td>
                <td><?= h($vacations->annee) ?></td>
                <td><?= h($vacations->nbHeure) ?></td>
                <td><?= h($vacations->dateInsertion) ?></td>
                <td><?= h($vacations->etat) ?></td>
                <td><?= h($vacations->vacataire_id) ?></td>
                <td><?= h($vacations->paimentvac_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Vacations', 'action' => 'view', $vacations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Vacations', 'action' => 'edit', $vacations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Vacations', 'action' => 'delete', $vacations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vacations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
