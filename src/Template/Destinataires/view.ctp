<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Destinataire'), ['action' => 'edit', $destinataire->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Destinataire'), ['action' => 'delete', $destinataire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $destinataire->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Destinataires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Destinataire'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="destinataires view large-9 medium-8 columns content">
    <h3><?= h($destinataire->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('NomComplet Destinataire') ?></th>
            <td><?= h($destinataire->nomComplet_destinataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adresse Destinataire') ?></th>
            <td><?= h($destinataire->adresse_destinataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Destinataire') ?></th>
            <td><?= h($destinataire->email_destinataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telephone Destinataire') ?></th>
            <td><?= h($destinataire->telephone_destinataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ville Destinataire') ?></th>
            <td><?= h($destinataire->ville_destinataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($destinataire->id) ?></td>
        </tr>
    </table>
</div>
