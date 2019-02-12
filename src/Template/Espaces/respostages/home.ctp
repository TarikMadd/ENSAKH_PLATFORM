<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Respo Stage
  </h1>
  
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <?php echo $this->Html->image('admin.png', array('class' => 'profile-user-img img-responsive img-circle', 'alt' => 'User profile picture')); ?>

          <h3 class="profile-username text-center">Service de Stage</h3>

          <p class="text-muted text-center">ANIBER Youssef</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Demandes En Attente</b> <a class="pull-right"><?= h($nEnvoye) ?></a>
            </li>
            <li class="list-group-item">
              <b>Demandes En Cours</b> <a class="pull-right"><?= h($nEncours) ?></a>
            </li>
            <li class="list-group-item">
              <b>Demandes Prête</b> <a class="pull-right"><?= h($nPrete) ?></a>
            </li>
            <li class="list-group-item">
              <b>Demandes Délivrés</b> <a class="pull-right"><?= h($nDelivre) ?></a>
            </li>
            <li class="list-group-item">
              <b>Demandes Rejetés</b> <a class="pull-right"><?= h($nRejete) ?></a>
            </li>
          </ul>

           <?= $this->Html->link(__('Afficher'), ['action' => 'indexCertificatsEtudiants'], ['class'=>'btn btn-primary btn-block']) ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- About Me Box -->
    
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Statistiques</a></li>
          <li><a href="#timeline" data-toggle="tab">Graphes</a></li>
         
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
      <div class="info-box">
           
          <!-- small box -->
          <span class="small-box bg-green">
            <span class="inner">
              <h3>Statistiques</h3>

              <p>Par filières </p>
            </span>
            <span class="icon">
              <i class="ion ion-stats-bars"></i>
            </span>
            
                      
              <?= $this->Html->link(__('Voir'), ['action' => 'statiqtiquesCertificatsEtudiants'], ['class'=>'btn btn-success btn-block']) ?>         
            
          </span>
       

            <div class="info-box-content">
             
            </div>
            <!-- /.info-box-content -->
          </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
      <div class="info-box">
            <span class="small-box bg-red">
            <span class="inner">
              <h3>Graphes</h3>

              <p>Par filières</p>
            </span>
            <span class="icon">
              <i class="ion ion-pie-graph"></i>
            </span>
           <?= $this->Html->link(__('Voir'), ['action' => 'graphesCertificatsEtudiants'], ['class'=>'btn btn-danger btn-block']) ?>
          </span>

            <div class="info-box-content">
              
              
             

            </div>
       
          
           
            <!-- /.info-box-content -->
          </div>
           
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->
