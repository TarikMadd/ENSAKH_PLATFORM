
<section class="content-header">
  <h1>
    Certificats Etudiant
    <small><?= __('Cmnt') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'indexCertificatsEtudiants'], ['escape' => false]) ?>
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
        <?php if(isset($test)): ?>
        <form action="<?= $this->Url->build(); ?>" method="post">
        <div class="box-body">
          <textarea name="commentaire" placeholder="Entrez la raison du rejet" rows="4"></textarea>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <div class="col-sm-2">
          
            <input type="submit" name="rejeterprince" value="Rejeter" class="btn btn-danger pull-left btn-block btn-sm">
         
          </div>
          </div>
        </form>
      <?php else: ?>
        <form action="<?= $this->Url->build(); ?>" method="post">
        <div class="box-body">
          <textarea name="commentaire" class="textarea wysihtml5-editor" placeholder="Entrez le commentaire"></textarea>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <div class="col-sm-2">
            <input type="submit" name="Envoyer" value="Envoyer" class="btn btn-success pull-left btn-block btn-sm">
            </div>
          </div>
        </form>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>
