<section class="content-header">
  <h1>
    Article
    <small><?= __('Ajouter') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'index_articles'], ['escape' => false]) ?>
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
        <?= $this->Form->create() ?> <!--$article, array('role' => 'form')-->
          <div class="box-body">
          <?php
            echo $this->Form->input('stock_categorie_id', ['options' => $stockCategories]);
            echo $this->Form->input('label_article',['required' => true]);
            echo $this->Form->input('quantite_min',['required' => true]);
            echo $this->Form->input('marque',['required' => true]);
            echo $this->Form->input('quantite',['required' => true]);
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
