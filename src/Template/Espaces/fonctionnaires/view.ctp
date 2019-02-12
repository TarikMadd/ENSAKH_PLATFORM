<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fonctionnaire'), ['action' => 'edit', $fonctionnaire->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fonctionnaire'), ['action' => 'delete', $fonctionnaire->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fonctionnaire->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fonctionnaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fonctionnaire'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Missions'), ['controller' => 'Missions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mission'), ['controller' => 'Missions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activites'), ['controller' => 'Activites', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activite'), ['controller' => 'Activites', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grades'), ['controller' => 'Grades', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grade'), ['controller' => 'Grades', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fonctionnaires view large-9 medium-8 columns content">
    <h3><?= h($fonctionnaire->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Somme') ?></th>
            <td><?= h($fonctionnaire->somme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $fonctionnaire->has('user') ? $this->Html->link($fonctionnaire->user->id, ['controller' => 'Users', 'action' => 'view', $fonctionnaire->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Fct') ?></th>
            <td><?= h($fonctionnaire->nom_fct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom Fct') ?></th>
            <td><?= h($fonctionnaire->prenom_fct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LieuNaissance') ?></th>
            <td><?= h($fonctionnaire->lieuNaissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Specialite') ?></th>
            <td><?= h($fonctionnaire->specialite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situation Familiale') ?></th>
            <td><?= h($fonctionnaire->situation_Familiale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($fonctionnaire->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CIN') ?></th>
            <td><?= h($fonctionnaire->CIN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genre') ?></th>
            <td><?= h($fonctionnaire->genre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($fonctionnaire->photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fonctionnaire->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Salaire') ?></th>
            <td><?= $this->Number->format($fonctionnaire->salaire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat') ?></th>
            <td><?= $this->Number->format($fonctionnaire->etat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat Attestation') ?></th>
            <td><?= $this->Number->format($fonctionnaire->etat_attestation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat Fiche') ?></th>
            <td><?= $this->Number->format($fonctionnaire->etat_fiche) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= $this->Number->format($fonctionnaire->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Age') ?></th>
            <td><?= $this->Number->format($fonctionnaire->age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nbr Enfants') ?></th>
            <td><?= $this->Number->format($fonctionnaire->nbr_enfants) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsPassExam') ?></th>
            <td><?= $this->Number->format($fonctionnaire->isPassExam) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Recrut') ?></th>
            <td><?= h($fonctionnaire->date_Recrut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateNaissance') ?></th>
            <td><?= h($fonctionnaire->dateNaissance) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Missions') ?></h4>
        <?php if (!empty($fonctionnaire->missions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Date Depart') ?></th>
                <th scope="col"><?= __('Date Arrivee') ?></th>
                <th scope="col"><?= __('Mode Transport') ?></th>
                <th scope="col"><?= __('Nbr Nuit') ?></th>
                <th scope="col"><?= __('Taux') ?></th>
                <th scope="col"><?= __('Indemnite Kilometrique') ?></th>
                <th scope="col"><?= __('Indemnite Appliquee') ?></th>
                <th scope="col"><?= __('Montant Indemnite') ?></th>
                <th scope="col"><?= __('Motif') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col"><?= __('Fonctionnaire Id') ?></th>
                <th scope="col"><?= __('Profpermanent Id') ?></th>
                <th scope="col"><?= __('Ville Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fonctionnaire->missions as $missions): ?>
            <tr>
                <td><?= h($missions->id) ?></td>
                <td><?= h($missions->date_depart) ?></td>
                <td><?= h($missions->date_arrivee) ?></td>
                <td><?= h($missions->mode_transport) ?></td>
                <td><?= h($missions->nbr_nuit) ?></td>
                <td><?= h($missions->taux) ?></td>
                <td><?= h($missions->indemnite_kilometrique) ?></td>
                <td><?= h($missions->indemnite_appliquee) ?></td>
                <td><?= h($missions->montant_indemnite) ?></td>
                <td><?= h($missions->Motif) ?></td>
                <td><?= h($missions->total) ?></td>
                <td><?= h($missions->fonctionnaire_id) ?></td>
                <td><?= h($missions->profpermanent_id) ?></td>
                <td><?= h($missions->ville_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Missions', 'action' => 'view', $missions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Missions', 'action' => 'edit', $missions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Missions', 'action' => 'delete', $missions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $missions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Activites') ?></h4>
        <?php if (!empty($fonctionnaire->activites)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('NomActivite') ?></th>
                <th scope="col"><?= __('DateDebut') ?></th>
                <th scope="col"><?= __('DateFin') ?></th>
                <th scope="col"><?= __('Photo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fonctionnaire->activites as $activites): ?>
            <tr>
                <td><?= h($activites->id) ?></td>
                <td><?= h($activites->nomActivite) ?></td>
                <td><?= h($activites->dateDebut) ?></td>
                <td><?= h($activites->dateFin) ?></td>
                <td><?= h($activites->photo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activites', 'action' => 'view', $activites->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activites', 'action' => 'edit', $activites->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activites', 'action' => 'delete', $activites->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activites->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Grades') ?></h4>
        <?php if (!empty($fonctionnaire->grades)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('CodeGrade') ?></th>
                <th scope="col"><?= __('Taux') ?></th>
                <th scope="col"><?= __('NomGrade') ?></th>
                <th scope="col"><?= __('Categorie') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fonctionnaire->grades as $grades): ?>
            <tr>
                <td><?= h($grades->id) ?></td>
                <td><?= h($grades->codeGrade) ?></td>
                <td><?= h($grades->taux) ?></td>
                <td><?= h($grades->nomGrade) ?></td>
                <td><?= h($grades->categorie) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Grades', 'action' => 'view', $grades->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Grades', 'action' => 'edit', $grades->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Grades', 'action' => 'delete', $grades->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grades->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Services') ?></h4>
        <?php if (!empty($fonctionnaire->services)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nom Service') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fonctionnaire->services as $services): ?>
            <tr>
                <td><?= h($services->id) ?></td>
                <td><?= h($services->nom_service) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Services', 'action' => 'view', $services->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Services', 'action' => 'edit', $services->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Services', 'action' => 'delete', $services->id], ['confirm' => __('Are you sure you want to delete # {0}?', $services->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
