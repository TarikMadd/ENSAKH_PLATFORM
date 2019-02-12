<section class="content-header">
  
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'indexExpediteur'], ['escape' => false])?>
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
          <h1 class="box-title" >Expéditeur</h1>
        </div><!-- /.box-header -->
        <div class="box-body" style="text-align:center;">


         <h3 class="box-title">Informations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Nom complet</dt>
                <dd><?= h($expediteur->nomComplet_expediteur) ?> <br></dd>
                <dt>Adresse</dt>
                <dd><?= h($expediteur->adresse_expediteur) ?></dd>
                <dt>Email</dt>
                <dd><?= h($expediteur->email_expediteur) ?></dd>
                <dt>Ville</dt>
                <dd><?= h($expediteur->ville_expediteur) ?></dd>
                <dt>Pays</dt>
                <dd><?= h($expediteur->pays_expediteur) ?></dd>
                <dt>Téléphone</dt>
                <dd><?= h("0".$expediteur->telephone_expediteur) ?></dd>
              </dl>
            </div>
            <!-- /.box-body -->
        </div>

        <!-- /.box -->
    </div>
    <!-- ./col -->


</div>
<!-- div -->





    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>

                    <h3 class="box-title"><?= __('Les courriers reçus') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($expediteur->courrier_arrivees)): ?>

                    <table id="example2" class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Numéro Enregistrement
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date Arrivée
                                    </th>
                                        
                                                                    
                                    <th>
                                    Désignation
                                    </th>
                                        
                                                                    
                                   
                                        
                                                                    
                                    <th>
                                    Type Courrier
                                    </th>
                                        
                                                                    
                                    
                                        
                                                                    
                                    
                                        
                                                                    
                                    <th>
                                    Etat Du Courrier
                                    </th>
                                        
                                                                    
                                   
                                        
                                                                    
                                   
                                        
                                                                    
                                
                            </tr>

                            <?php foreach ($expediteur->courrier_arrivees as $courrierArrivees): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($courrierArrivees->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($courrierArrivees->date_arrivee) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($courrierArrivees->Désignation) ?>
                                    </td>
                                                                        
                                    
                                                                        
                                    <td>
                                    <?= h($courrierArrivees->type_courrier) ?>
                                    </td>
                                                                        
                                    
                                                                        
                                    
                                                                        
                                    <td>
                                    <?= h($courrierArrivees->etat_du_courrier) ?>
                                    </td>
                                                                        
                                    
                                                                        
                                    
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
   
</section>
