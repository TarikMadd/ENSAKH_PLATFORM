<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Courrier Arrivee
    <small><?= __('Editer') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Retour'), ['action' => 'indexArrivee'], ['escape' => false]) ?>
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
        <?= $this->Form->create($courrierArrivee, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('date_arrivee');
            echo $this->Form->input('Désignation');
           
            echo $this->Form->input('type_courrier');
            echo $this->Form->input('date_limite_du_traitement');

           ?>
           <label> Priorité </label>
                  <?php echo '<select name="Priorité" style="width: 100%; height:40px;" class="form-control select2" >'; ?>
                 <?php
                 echo '<option selected value="'.$courrierArrivee["Priorité"].'" style="width: 100%;" >' .$courrierArrivee["Priorité"].'</option>' ; ?>
                    <?php foreach($courrierArrivee as $var)
                        {
                          echo '<option value="'.$var['Priorité'].'" style="width: 100%;" >' .$var['Priorité'].'</option>';
                        }
                    echo '<option value="Normal">Normal</option>';
                    echo '<option value="Urgent">Urgent</option>';
                    echo '<option value="Trés Urgent">Trés Urgent</option>';

                  echo '</select>';?> <br>
          <?php
            echo $this->Form->input('etat_du_courrier');
          ?>
          <label> Courrier retourne </label>
                  <?php echo '<select name="courrier_retourne" style="width: 100%; height:40px;" class="form-control select2" >'; ?>
                 <?php   echo '<option selected value="'.$courrierArrivee["courrier_retourne"].'" style="width: 100%;" >' .$courrierArrivee["courrier_retourne"].'</option>' ; ?>
                    <?php foreach($courrierArrivee as $var)
                        {
                          echo '<option value="'.$var['courrier_retourne'].'" style="width: 100%;" >' .$var['courrier_retourne'].'</option>';
                        }
                    echo '<option value="Oui">Oui</option>';
                    echo '<option value="Non">Non</option>';

                  echo '</select>';?> <br>
         
         <label> Expéditeur </label>
                  <?php echo '<select name="expediteur_id" style="width: 100%; height:40px;" class="form-control select2" >'; ?>
                 <?php   echo '<option selected value="'.$exp[0]["id"].'" style="width: 100%;" >' .$exp[0]["nomComplet_expediteur"].'</option>' ; ?>
                    <?php foreach($expediteurs as $var)
                        {
                          echo '<option value="'.$var['id'].'" style="width: 100%;" >' .$var['nomComplet_expediteur'].'</option>';
                        }
                  echo '</select>';?> <br/>
           <label> Service </label>
                  <?php echo '<select name="service_id" style="width: 100%; height:40px;" class="form-control select2" >'; ?>
                    <?php echo '<option selected value="'.$serv[0]['id'].'" style="width: 100%;" >' .$serv[0]['nom_service'].'</option>'; ?>
                    <?php foreach($services as $ib)
                        {

                          echo '<option value="'.$ib['id'].'" style="width: 100%;" >' .$ib['nom_service'].'</option>';
                        }
                  echo '</select>';?> <br/>        

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Enregistrer')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>
<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });
</script>
<?php $this->end(); ?>
<?php
$this->Html->css([
    'AdminLTE./plugins/daterangepicker/daterangepicker-bs3',
    'AdminLTE./plugins/iCheck/all',
    'AdminLTE./plugins/colorpicker/bootstrap-colorpicker.min',
    'AdminLTE./plugins/timepicker/bootstrap-timepicker.min',
    'AdminLTE./plugins/select2/select2.min',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/select2/select2.full.min',
  'AdminLTE./plugins/input-mask/jquery.inputmask',
  'AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions',
  'AdminLTE./plugins/input-mask/jquery.inputmask.extensions',
  'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
  'AdminLTE./plugins/daterangepicker/daterangepicker',
  'AdminLTE./plugins/colorpicker/bootstrap-colorpicker.min',
  'AdminLTE./plugins/timepicker/bootstrap-timepicker.min',
  'AdminLTE./plugins/iCheck/icheck.min',
],
['block' => 'script']);
?>
