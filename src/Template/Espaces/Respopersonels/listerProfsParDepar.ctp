<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>
        Départements :
        <small>Départements situés à l'ENSA KHOURIBGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $grtProf ?> Membre</h3>

              <p>Génie réseaux et télécoms</p>
            </div>
            <div >
              <i >
                                    <p class="text"><?php echo $this->Html->link(__('Lister Membres'), ['action' => 'listerProFParDeparBis', 1,'GRT'], ['class'=>'btn btn-warning btn-xs']  );?></p>

              </i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$giProf ?> Membre</h3>

              <p>Génie Informatique</p>
            </div>
            <div >
              <i >
                                                  <p class="text"><?php echo $this->Html->link(__('Lister Membres'), ['action' => 'listerProFParDeparBis', 2,'GI'], ['class'=>'btn btn-warning btn-xs']  );?></p>
</i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $geProf?> Membre</h3>

              <p>Génie Eléctrique</p>
            </div>
            <div>
              <i >                                    <p class="text"><?php echo $this->Html->link(__('Lister Membres'), ['action' => 'listerProFParDeparBis', 3,'GE'], ['class'=>'btn btn-warning btn-xs']  );?></p>
</i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $gpeeProf ?> Membre</h3>

              <p>Génie des procédés</p>
            </div>
            <div >
              <i >                                    <p class="text"><?php echo $this->Html->link(__('Lister Membres'), ['action' => 'listerProFParDeparBis', 4,'GPEE'], ['class'=>'btn btn-warning btn-xs']  );?></p>
</i>
            </div>

          </div>
        </div>
        <!-- ./col -->
      </div>
              <div class="pull-right"><?= $this->Html->link(__('Nouvelle Affectation'), ['action' => 'affecterProfDepar'], ['class'=>'btn btn-success btn-xs']) ?></div>
