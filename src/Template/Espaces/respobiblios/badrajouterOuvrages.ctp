<section class="content-header">
  <h1>
    Ajouter un Ouvrage
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Acceuil'), ['action' => 'index'], ['escape' => false]) ?>
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
          <h3 class="box-title"><i class="glyphicon glyphicon-info-sign"></i><?= __('Information') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($book ,array('type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('titre');
            echo $this->Form->input('auteur');
            echo $this->Form->input('edition');
            echo $this->Form->input('resumer');
            echo $this->Form->input('ISBN');
            echo $this->Form->input('nbExemplaire' , ['label' => "nombre d'éxemplaires"]);
            echo $this->Form->input('categorie', ['label' => 'Catégorie','empty'=> '(choisissez une Catégorie)', 'options' => $categorie, 'onchange'=>"this.form.submit()"]);
            if (isset($selection)) {
              echo $this->Form->input('sous_categorie_id', ['label' => 'Sous Catégorie', 'options' => $souscategorie]);
            }
            else
              echo $this->Form->input('sous_categorie_id', ['label' => 'Sous Catégorie','disabled' => 'disabled']);
            echo $this->Form->input('users._ids', ['options' => $users,'type' => 'hidden']);
            echo $this->Form->input('image', array('type' => 'file'));
          ?>
          </div>
          <div class="box-footer">
            <?= $this->Form->button(__('Poursuivre')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
