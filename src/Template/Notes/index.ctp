<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note[]|\Cake\Collection\CollectionInterface $notes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Note'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Etudiers'), ['controller' => 'Etudiers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Etudier'), ['controller' => 'Etudiers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pvupdate'), ['controller' => 'Pvupdate', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pvupdate'), ['controller' => 'Pvupdate', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notes index large-9 medium-8 columns content">
    <h3><?= __('Notes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('element_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('etudier_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('note') ?></th>
                <th scope="col"><?= $this->Paginator->sort('note_ratt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('confirmed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ratt_confirmed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('saved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ratt_saved') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note): ?>
            <tr>
                <td><?= $this->Number->format($note->id) ?></td>
                <td><?= $note->has('element') ? $this->Html->link($note->element->id, ['controller' => 'Elements', 'action' => 'view', $note->element->id]) : '' ?></td>
                <td><?= $note->has('etudier') ? $this->Html->link($note->etudier->id, ['controller' => 'Etudiers', 'action' => 'view', $note->etudier->id]) : '' ?></td>
                <td><?= $this->Number->format($note->note) ?></td>
                <td><?= $this->Number->format($note->note_ratt) ?></td>
                <td><?= $this->Number->format($note->confirmed) ?></td>
                <td><?= h($note->ratt_confirmed) ?></td>
                <td><?= $this->Number->format($note->saved) ?></td>
                <td><?= h($note->ratt_saved) ?></td>
                <td><?= h($note->created_at) ?></td>
                <td><?= h($note->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $note->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $note->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $note->id], ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
