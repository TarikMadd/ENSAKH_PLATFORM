<section class="content-header">
  <h1>
    Nouveau Etudiant
    <small><?= __('Creation de compte') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-undo"></i> '.__('Retour vers la liste des étudiants'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($user, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('username',['label'=>'Nom de compte (CNE)']);
            echo $this->Form->input('password',['label'=>'Mot de Passe (Date de Naissance sous forme de : jjmmaaaa)']);
            echo $this->Form->hidden('role', ['value'=>'etudiant']);
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Valider')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
