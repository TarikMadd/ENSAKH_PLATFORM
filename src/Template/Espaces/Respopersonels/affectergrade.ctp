<section class="content-header">
  <h1>
    Vacataires Grade
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
        <?= $this->Form->create($vacatairesGrade, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('datedebut');
            echo $this->Form->input('datefin');
            
          ?>
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
                     <div class="box-body">
          
                   <div class="col-md-12">
                        <div class="form-group">
                            <label>GRADE </label>
                            <select class="form-control select2" name="grade_id" style="width: 100%;" required>
                            <?php
                            foreach($grades as $grade){
                                echo "<option value ='$grade->id'>".$grade->nomGrade."</option>";
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
