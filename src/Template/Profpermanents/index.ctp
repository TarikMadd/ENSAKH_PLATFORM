<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Profpermanent'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Enseigners'), ['controller' => 'Enseigners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Enseigner'), ['controller' => 'Enseigners', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sup Heures'), ['controller' => 'SupHeures', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sup Heure'), ['controller' => 'SupHeures', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activites'), ['controller' => 'Activites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activite'), ['controller' => 'Activites', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departements'), ['controller' => 'Departements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Departement'), ['controller' => 'Departements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Discipline'), ['controller' => 'Disciplines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grades'), ['controller' => 'Grades', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grade'), ['controller' => 'Grades', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="profpermanents index large-9 medium-8 columns content">
    <h3><?= __('Profpermanents') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('somme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('poste') ?></th>
                <th scope="col"><?= $this->Paginator->sort('echelle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('echelon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('etat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_Recrut') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nom_prof') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prenom_prof') ?></th>
                <th scope="col"><?= $this->Paginator->sort('age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diplome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('specialite') ?></th>
                <th scope="col"><?= $this->Paginator->sort('situation_familiale') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code_situation_admin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dateNaissance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('codeEtablissement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Lieu_Naissance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CIN') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_prof') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('etat_attestation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('etatdemande') ?></th>
                <th scope="col"><?= $this->Paginator->sort('photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('etat_fichesalaire') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profpermanents as $profpermanent): ?>
            <tr>
                <td><?= $this->Number->format($profpermanent->id) ?></td>
                <td><?= $profpermanent->has('user') ? $this->Html->link($profpermanent->user->id, ['controller' => 'Users', 'action' => 'view', $profpermanent->user->id]) : '' ?></td>
                <td><?= h($profpermanent->somme) ?></td>
                <td><?= h($profpermanent->poste) ?></td>
                <td><?= $this->Number->format($profpermanent->echelle) ?></td>
                <td><?= $this->Number->format($profpermanent->echelon) ?></td>
                <td><?= h($profpermanent->etat) ?></td>
                <td><?= h($profpermanent->date_Recrut) ?></td>
                <td><?= h($profpermanent->nom_prof) ?></td>
                <td><?= h($profpermanent->prenom_prof) ?></td>
                <td><?= $this->Number->format($profpermanent->age) ?></td>
                <td><?= h($profpermanent->diplome) ?></td>
                <td><?= h($profpermanent->specialite) ?></td>
                <td><?= h($profpermanent->situation_familiale) ?></td>
                <td><?= $this->Number->format($profpermanent->code_situation_admin) ?></td>
                <td><?= h($profpermanent->dateNaissance) ?></td>
                <td><?= $this->Number->format($profpermanent->codeEtablissement) ?></td>
                <td><?= h($profpermanent->Lieu_Naissance) ?></td>
                <td><?= $this->Number->format($profpermanent->CIN) ?></td>
                <td><?= h($profpermanent->email_prof) ?></td>
                <td><?= h($profpermanent->phone) ?></td>
                <td><?= $this->Number->format($profpermanent->etat_attestation) ?></td>
                <td><?= $this->Number->format($profpermanent->etatdemande) ?></td>
                <td><?= h($profpermanent->photo) ?></td>
                <td><?= $this->Number->format($profpermanent->etat_fichesalaire) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $profpermanent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $profpermanent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $profpermanent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profpermanent->id)]) ?>
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
