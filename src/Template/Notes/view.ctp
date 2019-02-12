<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note $note
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Note'), ['action' => 'edit', $note->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Etudiers'), ['controller' => 'Etudiers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Etudier'), ['controller' => 'Etudiers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pvupdate'), ['controller' => 'Pvupdate', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pvupdate'), ['controller' => 'Pvupdate', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notes view large-9 medium-8 columns content">
    <h3><?= h($note->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Element') ?></th>
            <td><?= $note->has('element') ? $this->Html->link($note->element->id, ['controller' => 'Elements', 'action' => 'view', $note->element->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etudier') ?></th>
            <td><?= $note->has('etudier') ? $this->Html->link($note->etudier->id, ['controller' => 'Etudiers', 'action' => 'view', $note->etudier->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($note->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note') ?></th>
            <td><?= $this->Number->format($note->note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note Ratt') ?></th>
            <td><?= $this->Number->format($note->note_ratt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Confirmed') ?></th>
            <td><?= $this->Number->format($note->confirmed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Saved') ?></th>
            <td><?= $this->Number->format($note->saved) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($note->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($note->updated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ratt Confirmed') ?></th>
            <td><?= $note->ratt_confirmed ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ratt Saved') ?></th>
            <td><?= $note->ratt_saved ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Pvupdate') ?></h4>
        <?php if (!empty($note->pvupdate)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Profpermanent Id') ?></th>
                <th scope="col"><?= __('Note Id') ?></th>
                <th scope="col"><?= __('Date Update') ?></th>
                <th scope="col"><?= __('Profvacataire Id') ?></th>
                <th scope="col"><?= __('Note Old') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($note->pvupdate as $pvupdate): ?>
            <tr>
                <td><?= h($pvupdate->id) ?></td>
                <td><?= h($pvupdate->profpermanent_id) ?></td>
                <td><?= h($pvupdate->note_id) ?></td>
                <td><?= h($pvupdate->date_update) ?></td>
                <td><?= h($pvupdate->profvacataire_id) ?></td>
                <td><?= h($pvupdate->note_old) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pvupdate', 'action' => 'view', $pvupdate->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pvupdate', 'action' => 'edit', $pvupdate->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pvupdate', 'action' => 'delete', $pvupdate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pvupdate->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
