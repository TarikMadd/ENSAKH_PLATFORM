<section class="content-header">

  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'rechercher'], ['escape' => false])?>
    </li>
  </ol>
</section><br><br>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <center><div class="box box-solid" style='width:500px'>
            <div class="box-header with-border">

                <div class="panel panel-primary">
                     <div class="panel-heading"> <i class="fa fa-info" ></i>Informations Supplémentaires </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">

                                                                                                                        <dt><?= __('Somme') ?></dt>
                                        <dd >
                                          <?= h($profpermanent->somme) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Poste') ?></dt>
                                         <dd >
                                            <?= h($profpermanent->poste) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Nom Prof') ?></dt>
                                        <dd >
                                            <?= h($profpermanent->nom_prof) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Prof') ?></dt>
                                        <dd >
                                            <?= h($profpermanent->prenom_prof) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Diplome') ?></dt>
                                        <dd>
                                            <?= h($profpermanent->diplome) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Specialite') ?></dt>
                                        <dd >
                                            <?= h($profpermanent->specialite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Situation Familiale') ?></dt>
                                          <dd >
                                            <?= h($profpermanent->situation_familiale) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Lieu Naissance') ?></dt>
                                         <dd >
                                            <?= h($profpermanent->Lieu_Naissance) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Email Prof') ?></dt>
                                         <dd >
                                            <?= h($profpermanent->email_prof) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Phone') ?></dt>
                                          <dd >
                                            <?= h($profpermanent->phone) ?>
                                        </dd>




                                                                                                                <dt><?= __('Etat') ?></dt>
                                 <dd >
                                    <?= $this->Number->format($profpermanent->etat) ?>
                                </dd>
                                                                                                                <dt><?= __('Age') ?></dt>
                                 <dd >
                                    <?= $this->Number->format($profpermanent->age) ?>
                                </dd>


                                                                                                                <dt><?= __('CIN') ?></dt>
                                 <dd >
                                    <?= $this->Number->format($profpermanent->CIN) ?>
                                </dd>

                                                                                                        <dt><?= __('Date Recrut') ?></dt>
                                <dd >
                                    <?= h($profpermanent->date_Recrut) ?>
                                </dd>
                                                                                                                    <dt><?= __('DateNaissance') ?></dt>
                                 <dd>
                                    <?= h($profpermanent->dateNaissance) ?>
                                </dd>


                                                                        <dt><?= __('Universite') ?></dt>
                             <dd >
                            <?= $this->Text->autoParagraph(h($profpermanent->universite)); ?>
                            </dd>
                                                    <dt><?= __('Autresdiplomes') ?></dt>
                            <dd >
                            <?= $this->Text->autoParagraph(h($profpermanent->autresdiplomes)); ?>
                            </dd>
                                                            </dl>
            </div>
            <!-- /.box-body -->
        </div></center>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>