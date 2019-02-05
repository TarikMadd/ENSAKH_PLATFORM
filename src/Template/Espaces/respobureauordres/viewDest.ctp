<section class="content-header">
  
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'indexDest'], ['escape' => false])?>
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
          <h1 class="box-title" >Destinataire</h1>
        </div><!-- /.box-header -->
        <div class="box-body" style="text-align:center;">


         <h3 class="box-title">Informations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Nom complet</dt>
                <dd><?= h($destinataire->nomComplet_destinataire) ?> <br></dd>
                <dt>Adresse</dt>
                <dd><?= h($destinataire->adresse_destinataire) ?></dd>
                <dt>Email</dt>
                <dd><?= h($destinataire->email_destinataire) ?></dd>
                <dt>Telephone</dt>
                <dd><?= h($destinataire->telephone_destinataire) ?></dd>
                <dt>Ville</dt>
                <dd><?= h($destinataire->ville_destinataire) ?></dd>
                <dt>Pays</dt>
                <dd><?= h($destinataire->pays_destinataire) ?></dd>
                
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

                    <h3 class="box-title"><?= __('Relation {0}', ['Courriers Départ']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($destinataire->courrier_departs)): ?>

                    <table id="example2" class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Numéro Enregistrement
                                    </th>
                                        
                                                                    
                                    <th>
                                    Date Départ
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

                            <?php foreach ($destinataire->courrier_departs as $courrierDeparts): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($courrierDeparts->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($courrierDeparts->date_depart) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($courrierDeparts->désignation) ?>
                                    </td>
                                                                        
                                    
                                                                        
                                    <td>
                                    <?= h($courrierDeparts->type_courrier) ?>
                                    </td>
                                                                        
                                    
                                                                        
                                    
                                                                        
                                    <td>
                                    <?= h($courrierDeparts->etat_courrier) ?>
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
