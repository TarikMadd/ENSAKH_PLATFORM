<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Respo Stage
  </h1>
  
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
   
    <!-- /.col -->
    <div class="col-xs-12">
     <div class="box">
     <div class="box-header">
          <h3 class="box-title"><?= __('List des') ?> Certificats des etudiants</h3>
          <div class="box-tools">
             <?= $this->Html->link(__('Réinitialiser'), ['action' => 'reinitialiserCertificatsEtudiants'], ['class'=>'btn btn-danger btn-xs']) ?>
             <?= $this->Form->postLink(__('Vider la table'), ['action' => 'miseAzeroCertificatsEtudiants'], ['confirm' => __('Confirmer la mise à zero de la table ?'), 'class'=>'btn btn-danger btn-xs']) ?>
          </div>
        </div>
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#attente" data-toggle="tab">Demandes en attente</a></li>
          <li><a href="#enCours" data-toggle="tab">Demandes En cours...</a></li>
          <li><a href="#prete" data-toggle="tab">Demandes Prêtes</a></li>
           <li><a href="#delivre" data-toggle="tab">Demandes Délivrés</a></li>
          <li><a href="#rejete" data-toggle="tab">Demandes Rejetés</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="attente">
      <div class="info-box">
           <?php include'afficherTableEnvoye.ctp'; ?>

           
            <!-- /.info-box-content -->
          </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="enCours">
      <div class="info-box">
      <?php include'afficherTableEncours.ctp'; ?>
       </div>         
            <!-- /.info-box-content -->
          </div>
           
         
          <!-- /.tab-pane -->

          <div class="tab-pane" id="prete">
           <div class="info-box">
            <?php include'afficherTablePrete.ctp'; ?>
           </div>
           
          </div>
          <div class="tab-pane" id="delivre">
           <div class="info-box">
           <?php include'afficherTableDelivrer.ctp'; ?>
           </div>

          </div>
          <div class="tab-pane" id="rejete">
           <div class="info-box">
            <?php include'afficherTableRejeter.ctp'; ?>
           </div>
            
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
         </div>
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    </div>
    <!-- /.col -->
  
  <!-- /.row -->

</section>
<!-- /.content -->



