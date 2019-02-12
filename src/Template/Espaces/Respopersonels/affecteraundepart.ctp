<section class="content-header">
  <h1>
    Vacataires Departement
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
        <?= $this->Form->create($vacatairesDepartement, array('role' => 'form')) ?>
          <div class="box-body">
          
                   <div class="col-md-12">
                        <div class="form-group">
                            <label>Vacataire </label>
                            <select class="form-control select2" name="vacataire_id" style="width: 100%;" required>
                            <?php
                            foreach($vacataires as $vacataire){
                                echo "<option value ='$vacataire->id'>".$vacataire->nom_vacataire." ".$vacataire->prenom_vacataire." (".$vacataire->somme." )</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>


<div class="col-md-12">
                        <div class="form-group">
                            <label>Departement </label>
                            <select class="form-control select2" name="departement_id" style="width: 100%;" required>
                            <?php
                            foreach($departements as $departement){
                                echo "<option value ='$departement->id'>".$departement->nom_departement."</option>";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
          
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
