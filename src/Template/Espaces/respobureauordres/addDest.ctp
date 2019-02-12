<section class="content-header">
  <h1>
    Destinataire
    <small><?= __('Ajouter') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'indexDest'], ['escape' => false]) ?>
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
          <h3 class="box-title"><?= __('Formulaire') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($destinataire, array('role' => 'form')) ?>
          <div class="box-body">
          
            <div class="box-body">
            <h4>Nom Complet du Destinataire</h4>

              <div class="input-group">
               <div class="input-group-addon">
                    <i class="fa fa-fw fa-user"></i>
                  </div> 
                
                <input type="text" name="nomComplet_destinataire" class="form-control" placeholder="Nom Complet Destinataire">
              </div>
              <br>

              <h4>Adresse du Destinataire</h4>
            
              <div class="input-group">
               
                <div class="input-group-addon">
                    <i class="fa fa-fw fa-location-arrow"></i>
                  </div>
                
                <input type="text" name="adresse_destinataire" class="form-control" placeholder="Adresse Destinataire">
              </div>
              <br>

              <h4>Email du destinataire</h4>

              <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="email" name="email_destinataire" class="form-control" placeholder="Email">
              </div>
              <br>

              <h4>Telephone du Destinataire</h4>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="telephone_destinataire" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                </div>
                <br>


              <h4>Ville du Destinataire</h4>

              <div class="input-group">
              <div class="input-group-addon">
                    <i class="fa fa-fw fa-plane"></i>
                  </div>
              
                <input type="text" name="ville_destinataire" class="form-control" placeholder="ville">
              </div>
              <br>

              <h4>Pays du Destinataire</h4>

              <div class="input-group">
              <div class="input-group-addon">
                    <i class="fa fa-fw fa-plane"></i>
                  </div>
              
                <input type="text" name="pays_destinataire" class="form-control" placeholder="Pays">
              </div>
              <br>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Sauvegarder')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
