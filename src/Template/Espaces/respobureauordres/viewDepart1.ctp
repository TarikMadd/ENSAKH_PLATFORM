
<section class="content-header">
  
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'indexDepart1'], ['escape' => false])?>
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
          <h1 class="box-title" >Courrier Départ</h1>
        </div><!-- /.box-header -->
        <div class="box-body" style="text-align:center;">


         <h3 class="box-title">Informations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Désignation</dt>
                <dd><?= h($courrierDepart->désignation) ?> <br></dd>
                <dt>Destinataire</dt>
                <dd> <?= $courrierDepart->has('destinataire') ? $courrierDepart->destinataire->nomComplet_destinataire : '' ?></dd>
                <dt>Type Courrier</dt>
                <dd><?= h($courrierDepart->type_courrier) ?></dd>
                <dt>Service</dt>
                <dd>  <?= h($courrierDepart->service) ?></dd>
                <dt>Nécessité d'accusé</dt>
                <dd>  <?= h($courrierDepart->necessite) ?></dd>
                <dt>Etat Du Courrier</dt>
                <dd> <?= h($courrierDepart->etat_courrier) ?></dd>
                <dt>Date Départ</dt>
                <dd> <?= h($courrierDepart->date_depart) ?></dd>
                
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
























                            
