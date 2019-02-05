<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vacatairesbi'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vacatairesbis index large-9 medium-8 columns content">
    <h3><?= __('Vacatairesbis') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('somme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_vacataire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_vacataire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nb_heures') ?></th>
                <th scope="col"><?= $this->Paginator->sort('echelle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('echelon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dateRecrut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dateNaissance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LieuNaissance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diplome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('universite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('specialite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CIN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('situationFamiliale') ?></th>
                <th scope="col"><?= $this->Paginator->sort('codeSituation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dateAffectation') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vacatairesbis as $vacatairesbi): ?>
            <tr>
                <td><?= $this->Number->format($vacatairesbi->id) ?></td>
                <td><?= $vacatairesbi->has('user') ? $this->Html->link($vacatairesbi->user->id, ['controller' => 'Users', 'action' => 'view', $vacatairesbi->user->id]) : '' ?></td>
                <td><?= h($vacatairesbi->somme) ?></td>
                <td><?= h($vacatairesbi->nom_vacataire) ?></td>
                <td><?= h($vacatairesbi->prenom_vacataire) ?></td>
                <td><?= $this->Number->format($vacatairesbi->nb_heures) ?></td>
                <td><?= $this->Number->format($vacatairesbi->echelle) ?></td>
                <td><?= $this->Number->format($vacatairesbi->echelon) ?></td>
                <td><?= h($vacatairesbi->dateRecrut) ?></td>
                <td><?= h($vacatairesbi->dateNaissance) ?></td>
                <td><?= h($vacatairesbi->LieuNaissance) ?></td>
                <td><?= h($vacatairesbi->diplome) ?></td>
                <td><?= h($vacatairesbi->universite) ?></td>
                <td><?= h($vacatairesbi->specialite) ?></td>
                <td><?= h($vacatairesbi->CIN) ?></td>
                <td><?= h($vacatairesbi->situationFamiliale) ?></td>
                <td><?= h($vacatairesbi->codeSituation) ?></td>
                <td><?= h($vacatairesbi->dateAffectation) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vacatairesbi->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vacatairesbi->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vacatairesbi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vacatairesbi->id)]) ?>
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
