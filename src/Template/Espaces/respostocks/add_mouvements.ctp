<section class="content-header">
  <h1>
    Mouvement
    <small><?= __('Ajouter') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'index_mouvements'], ['escape' => false]) ?>
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
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($mouvement, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
		    echo $this->Form->input('article_id', ['options' => $articles]);
			echo $this->Form->input('magasin_id', ['options' => $magasins]);
            echo $this->Form->input('date_mouvement',['value' => 'now']);
            echo $this->Form->input('reference_sortie',['required' => true]);
            echo $this->Form->input('quantite_sortie',['required' => true]);
            echo $this->Form->input('service');
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
