<section class="content-header">
  <h1>
ORDRE DE PAIEMENT   
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Informations') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($ordrepaiement, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('identificateur_fiscale');
            echo $this->Form->input('num_compte_fournisseur',['label' => 'N° Compte Du Fournisseur']);
            echo $this->Form->input('banque',['label' => 'Banque Du fournisseur']);
            echo $this->Form->input('num_compte_paiement',['label' => 'N° Compte De Paiement']);
            echo $this->Form->input('num_facture',['label' => 'N° Facture']);
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
