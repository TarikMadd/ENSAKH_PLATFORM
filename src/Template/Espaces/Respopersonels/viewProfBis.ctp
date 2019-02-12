<section class="content-header">
  <h1>
    <?php echo __('Profpermanent'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'rechercher'], ['escape' => false])?>
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
                                        <dd class="bg-success">
                                          <?= h($profpermanent->somme) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Poste') ?></dt>
                                         <dd class="bg-success">
                                            <?= h($profpermanent->poste) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Nom Prof') ?></dt>
                                        <dd class="bg-success">
                                            <?= h($profpermanent->nom_prof) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Prof') ?></dt>
                                        <dd class="bg-success">
                                            <?= h($profpermanent->prenom_prof) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Diplome') ?></dt>
                                        <dd class="bg-success">
                                            <?= h($profpermanent->diplome) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Specialite') ?></dt>
                                        <dd class="bg-success">
                                            <?= h($profpermanent->specialite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Situation Familiale') ?></dt>
                                          <dd class="bg-success">
                                            <?= h($profpermanent->situation_familiale) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Lieu Naissance') ?></dt>
                                         <dd class="bg-success">
                                            <?= h($profpermanent->Lieu_Naissance) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email Prof') ?></dt>
                                         <dd class="bg-success">
                                            <?= h($profpermanent->email_prof) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone') ?></dt>
                                          <dd class="bg-success">
                                            <?= h($profpermanent->phone) ?>
                                        </dd>


                                                                                                                                                            <dt><?= __('Echelle') ?></dt>
                                 <dd class="bg-success">
                                    <?= $this->Number->format($profpermanent->echelle) ?>
                                </dd>

                                                                                                                <dt><?= __('Etat') ?></dt>
                                 <dd class="bg-success">
                                    <?= $this->Number->format($profpermanent->etat) ?>
                                </dd>
                                                                                                                <dt><?= __('Age') ?></dt>
                                 <dd class="bg-success">
                                    <?= $this->Number->format($profpermanent->age) ?>
                                </dd>
                                                                                                                <dt><?= __('Code Situation Admin') ?></dt>
                                 <dd class="bg-success">
                                    <?= $this->Number->format($profpermanent->code_situation_admin) ?>
                                </dd>
                                                                                                                <dt><?= __('CodeEtablissement') ?></dt>
                                  <dd class="bg-success">
                                    <?= $this->Number->format($profpermanent->codeEtablissement) ?>
                                </dd>
                                                                                                                <dt><?= __('CIN') ?></dt>
                                 <dd class="bg-success">
                                    <?= $this->Number->format($profpermanent->CIN) ?>
                                </dd>

                                                                                                        <dt><?= __('Date Recrut') ?></dt>
                                <dd class="bg-success">
                                    <?= h($profpermanent->date_Recrut) ?>
                                </dd>
                                                                                                                    <dt><?= __('DateNaissance') ?></dt>
                                 <dd class="bg-success">
                                    <?= h($profpermanent->dateNaissance) ?>
                                </dd>


                                                                        <dt><?= __('Universite') ?></dt>
                             <dd class="bg-success">
                            <?= $this->Text->autoParagraph(h($profpermanent->universite)); ?>
                            </dd>
                                                    <dt><?= __('Autresdiplomes') ?></dt>
                            <dd class="bg-success">
                            <?= $this->Text->autoParagraph(h($profpermanent->autresdiplomes)); ?>
                            </dd>
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>