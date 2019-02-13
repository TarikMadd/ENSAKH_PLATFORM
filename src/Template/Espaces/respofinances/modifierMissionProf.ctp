<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
  <h1>
    Mission
    <small><?= __('Edit') ?></small>
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
        <?= $this->Form->create($mission, array('role' => 'form')) ?>
          <div class="box-body">
            Date depart : <input type="date" name="date_depart" value="YYYY-MM-DD"><br>
            Date arrivee : <input type="date" name="date_arrivee" value="YYYY-MM-DD">
          <?php
            // echo $this->Form->input('date_depart');
            // echo $this->Form->input('date_arrivee');
            echo $this->Form->input('mode_transport', array('id'=>'mode','options' => array('voiture personnelle'=>'voiture personnelle', 'voiture de service'=>'voiture de service'),'onchange'=>'cache()'));
            echo('<br>');
            echo $this->Form->input('nbr_nuit');
            echo $this->Form->hidden('taux');
            echo $this->Form->input('Indemnité_appliquée_à_la_puissance_fiscale_de_la_voiture',array('id'=>'Ind','options' => array('1.20'=>'6 chevaux ou moins', '1.75'=>'entre 7 et 9 chevaux','2.30'=>'10 chevaux ou plus')));
            echo $this->Form->hidden('indemnite_appliquee');
            echo $this->Form->input('etat');
            //echo $this->Form->input('nom profs',['options' => $prof->nom_prof]);
            echo $this->Form->hidden('fonctionnaire_id', ['options' => $fonctionnaire ,'empty' => true]);
            //echo $this->Form->input('professeur_id', ['options' => $profpermanents]);
            ?>
            <script type="text/javascript"> 
            function cache(){
              if (this.value='voiture de service') {
              document.getElementById('Ind').style.display='none';
              }
               else{
                document.getElementById('Ind').style.display='block';
               }
            } 
          </script>
            <label>Professeur</label>
            <select name="Prof" class="form-control" >
                  <?php foreach ($profpermanent as $profpermanents): ?>
                      <option value=<?php echo $profpermanents['id']?>> <?php echo $profpermanents['somme']?></option>
                  <?php endforeach ?>
            </select>
            <label>ville</label>
            <select name="LaVille" class="form-control" >
                  <?php foreach ($ville as $villes): ?>
                      <option value=<?php echo $villes['id']?>> <?php echo $villes['nom']?></option>
                  <?php endforeach ?>
            </select>
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
