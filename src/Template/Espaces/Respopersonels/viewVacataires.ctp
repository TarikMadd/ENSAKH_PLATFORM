<section class="content-header">
  <h1>
    <?php echo __('Vacataire'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                                <dt><?= __('Somme') ?></dt>
                                        <dd>
                                            <?= h($vacataire->somme) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Nom Vacataire') ?></dt>
                                        <dd>
                                            <?= h($vacataire->nom_vacataire) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Vacataire') ?></dt>
                                        <dd>
                                            <?= h($vacataire->prenom_vacataire) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('LieuNaissance') ?></dt>
                                        <dd>
                                            <?= h($vacataire->LieuNaissance) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Diplome') ?></dt>
                                        <dd>
                                            <?= h($vacataire->diplome) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Universite') ?></dt>
                                        <dd>
                                            <?= h($vacataire->universite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Specialite') ?></dt>
                                        <dd>
                                            <?= h($vacataire->specialite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('CIN') ?></dt>
                                        <dd>
                                            <?= h($vacataire->CIN) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('SituationFamiliale') ?></dt>
                                        <dd>
                                            <?= h($vacataire->situationFamiliale) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('CodeSituation') ?></dt>
                                        <dd>
                                            <?= h($vacataire->codeSituation) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Nb Heures') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->nb_heures) ?>
                                </dd>
                                                                                                                <dt><?= __('Echelle') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->echelle) ?>
                                </dd>
                                                                                                                <dt><?= __('Echelon') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->echelon) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('DateRecrut') ?></dt>
                                <dd>
                                    <?= h($vacataire->dateRecrut) ?>
                                </dd>
                                                                                                                    <dt><?= __('DateNaissance') ?></dt>
                                <dd>
                                    <?= h($vacataire->dateNaissance) ?>
                                </dd>
                                                                                                                    <dt><?= __('DateAffectation') ?></dt>
                                <dd>
                                    <?= h($vacataire->dateAffectation) ?>
                                </dd>
                                                                                                    
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Documents']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->documents)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    IdDocument
                                    </th>
                                        
                                                                    
                                    <th>
                                    NbDocument
                                    </th>
                                        
                                                                    
                                    <th>
                                    NomDocument
                                    </th>
                                        
                                                                    
                                    <th>
                                    Profpermanent Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Vacataire Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Fonctionnaire Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($vacataire->documents as $documents): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($documents->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($documents->idDocument) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($documents->nbDocument) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($documents->nomDocument) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($documents->profpermanent_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($documents->vacataire_id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($documents->fonctionnaire_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Documents', 'action' => 'view', $documents->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Documents', 'action' => 'edit', $documents->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Documents', 'action' => 'delete', $documents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documents->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Vacations']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->vacations)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nbr Heures
                                    </th>
                                        
                                                                    
                                    <th>
                                    Somme Brute
                                    </th>
                                        
                                                                    
                                    <th>
                                    Taux
                                    </th>
                                        
                                                                    
                                    <th>
                                    Montant Impot
                                    </th>
                                        
                                                                    
                                    <th>
                                    Montant Net
                                    </th>
                                        
                                                                    
                                    <th>
                                    Vacataire Id
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($vacataire->vacations as $vacations): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($vacations->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->nbr_heures) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->somme_brute) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->taux) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->montant_impot) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->montant_net) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($vacations->vacataire_id) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Vacations', 'action' => 'view', $vacations->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Vacations', 'action' => 'edit', $vacations->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Vacations', 'action' => 'delete', $vacations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vacations->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Activites']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->activites)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    NomActivite
                                    </th>
                                        
                                                                    
                                    <th>
                                    DateDebut
                                    </th>
                                        
                                                                    
                                    <th>
                                    DateFin
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($vacataire->activites as $activites): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($activites->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activites->nomActivite) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activites->dateDebut) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activites->dateFin) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Activites', 'action' => 'view', $activites->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activites', 'action' => 'edit', $activites->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activites', 'action' => 'delete', $activites->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activites->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Departements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->departements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nom Departement
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nb Filiere
                                    </th>
                                        
                                                                    
                                    <th>
                                    Refer Depart
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($vacataire->departements as $departements): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($departements->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($departements->nom_departement) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($departements->nb_filiere) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($departements->refer_depart) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Departements', 'action' => 'view', $departements->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Departements', 'action' => 'edit', $departements->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Departements', 'action' => 'delete', $departements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departements->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Disciplines']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->disciplines)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nom Discipline
                                    </th>
                                        
                                                                    
                                    <th>
                                    Domaine Discipline
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($vacataire->disciplines as $disciplines): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($disciplines->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($disciplines->nom_discipline) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($disciplines->domaine_discipline) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Disciplines', 'action' => 'view', $disciplines->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Disciplines', 'action' => 'edit', $disciplines->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Disciplines', 'action' => 'delete', $disciplines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $disciplines->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Grades']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->grades)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    CodeGrade
                                    </th>
                                        
                                                                    
                                    <th>
                                    DateDebut
                                    </th>
                                        
                                                                    
                                    <th>
                                    DateFin
                                    </th>
                                        
                                                                    
                                    <th>
                                    Taux
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($vacataire->grades as $grades): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($grades->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->codeGrade) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->dateDebut) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->dateFin) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->taux) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Grades', 'action' => 'view', $grades->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Grades', 'action' => 'edit', $grades->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Grades', 'action' => 'delete', $grades->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grades->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
