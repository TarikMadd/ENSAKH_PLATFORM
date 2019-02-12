<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vacatairesbi'), ['action' => 'edit', $vacatairesbi->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vacatairesbi'), ['action' => 'delete', $vacatairesbi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vacatairesbi->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Vacatairesbis'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vacatairesbi'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="vacatairesbis view large-9 medium-8 columns content">
    <h3><?= h($vacatairesbi->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $vacatairesbi->has('user') ? $this->Html->link($vacatairesbi->user->id, ['controller' => 'Users', 'action' => 'view', $vacatairesbi->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Somme') ?></th>
            <td><?= h($vacatairesbi->somme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Vacataire') ?></th>
            <td><?= h($vacatairesbi->nom_vacataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom Vacataire') ?></th>
            <td><?= h($vacatairesbi->prenom_vacataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LieuNaissance') ?></th>
            <td><?= h($vacatairesbi->LieuNaissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diplome') ?></th>
            <td><?= h($vacatairesbi->diplome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Universite') ?></th>
            <td><?= h($vacatairesbi->universite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Specialite') ?></th>
            <td><?= h($vacatairesbi->specialite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CIN') ?></th>
            <td><?= h($vacatairesbi->CIN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SituationFamiliale') ?></th>
            <td><?= h($vacatairesbi->situationFamiliale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CodeSituation') ?></th>
            <td><?= h($vacatairesbi->codeSituation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vacatairesbi->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nb Heures') ?></th>
            <td><?= $this->Number->format($vacatairesbi->nb_heures) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelle') ?></th>
            <td><?= $this->Number->format($vacatairesbi->echelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelon') ?></th>
            <td><?= $this->Number->format($vacatairesbi->echelon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateRecrut') ?></th>
            <td><?= h($vacatairesbi->dateRecrut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateNaissance') ?></th>
            <td><?= h($vacatairesbi->dateNaissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateAffectation') ?></th>
            <td><?= h($vacatairesbi->dateAffectation) ?></td>
        </tr>
    </table>
</div>
