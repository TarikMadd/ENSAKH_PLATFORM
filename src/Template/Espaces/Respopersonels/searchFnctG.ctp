<section class="content-header">
  <h1>
    recherche des grades d'un fonctionnaire
    <small><?= __('Add') ?></small>
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
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create() ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('somme');
           
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"> Rechercher </button>
                   </span>
              </div>
            </form>
          </div>
        </div>
            <!--<?= $this->Form->button(__('Save')) ?>-->
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
