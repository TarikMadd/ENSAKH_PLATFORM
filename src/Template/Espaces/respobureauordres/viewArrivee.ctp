<section class="content-header">
  
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('retour'), ['action' => 'indexArrivee'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row" >
 <div class="col-md-4" >
 </div>
             <div class="col-md-4" >
      <div class="box box-solid box-primary" >
        <div class="box-header" style="text-align:center;">
          <h1 class="box-title" >Courrier Arrivée</h1>
        </div><!-- /.box-header -->
        <div class="box-body" style="text-align:center;">


         <h3 class="box-title">Informations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Désignation</dt>
                <dd><?= h($courrierArrivee->Désignation) ?> <br></dd>
                <dt>Nécessité Du Traitement</dt>
                <dd><?= h($courrierArrivee->necessité_du_traitement) ?></dd>
                <dt>Expéditeur</dt>
                <dd> <?= $courrierArrivee->has('expediteur') ? $courrierArrivee->expediteur->nomComplet_expediteur : '' ?></dd>
                <dt>Type Courrier</dt>
                <dd><?= h($courrierArrivee->type_courrier) ?></dd>
                <dt>Service Traitant</dt>
                <dd> <?= $courrierArrivee->has('service') ? $courrierArrivee->service->nom_service : '' ?></dd>
                <dt>Priorité</dt>
                <dd> <?= h($courrierArrivee->Priorité) ?></dd>
                <dt>Etat Du Courrier</dt>
                <dd> <?= h($courrierArrivee->etat_du_courrier) ?></dd>
                <dt>Date Arrivée</dt>
                <dd> <?= h($courrierArrivee->date_arrivee) ?></dd>
                <dt>Date Limite Du Traitement</dt>
                <dd><?= h($courrierArrivee->date_limite_du_traitement) ?></dd>
                <dt>Courrier Retourné</dt>
                <dd><?= h($courrierArrivee->courrier_retourne) ?></dd>
              </dl>
            </div>
            <!-- /.box-body -->
        </div>

        <!-- /.box -->
    </div>
    <!-- ./col -->


</div>
<!-- div -->


                                        
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->


</section>
