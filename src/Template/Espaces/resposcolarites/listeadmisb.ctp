<section class="content-header">
          <h4 style="margin-left: 12px;">
            <i class="fa fa-fw fa-file-text"></i>Liste des admis
          </h4>
          <ol class="breadcrumb" style="margin-right: 20px;">
            <li><?php if($_SESSION['etu'][0]['f']=='CP') echo "Cycle Préparatoire";else echo "Cycle Ingénieur";?></li>
            <li><?php echo $_SESSION['etu'][0]['n'];?></li>
            <li><?php echo $_SESSION['etu'][0]['f'];?></li>
          </ol>
</section>
<?php 
if($_SESSION['empty'] == 'no')
{ ?>

<section class="content">
  <div class="nav-tabs-custom">
              
                    <div class="tab-content no-padding">
                  
                  <div class="chart tab-pane active" id="notes" style="position: relative;">
                    <div class="box-body">
                  <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="80">
                  <col width="220">
                  <col width="220">
                  <col width="30">
                  <col width="30">
                  <thead>
                      <tr style="text-align: center";>
                        <th colspan="4" style="text-align: center";>ETUDIANT</th>
                        <th rowspan="2" style="vertical-align: middle;">NOTE GENERALE</th>
                        <th rowspan="2" style="vertical-align: middle;">DECISION</th>
                      </tr>
                      <tr>
                        <th style="text-align: center">N°</th>
                        <th style="text-align: center">CNE</th>
                        <th style="text-align: center">Nom</th>
                        <th style="text-align: center">Prenom</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $j=0; 
                      foreach ($_SESSION['etudiants'] as $etudiant) 
                      {?>
                      <tr>
                        <td><?php echo $j+1?></td>
                        <td><?php echo $etudiant['cne']?></td>
                        <td><?php echo $etudiant['nom_fr']?></td>
                        <td><?php echo $etudiant['prenom_fr']?></td> 
                        <td><?php echo number_format($_SESSION['moyenneGeneral'][$j],3);?></td>
                        <td><?php if($_SESSION['etu'][0]['id'] ==1 || $_SESSION['etu'][0]['id'] ==2) {if($_SESSION['moyenneGeneral'][$j]>=10) echo "ADMIS"; else echo "NON ADMIS";} else {if($_SESSION['moyenneGeneral'][$j]>=12) echo "ADMIS"; else echo "NON ADMIS";}?></td>
                      </tr>
                      <?php $j++; }?>
                      
                    </tbody>
                  </table>
                </div>
                  </div>
                </div>

              </div>
               <div class="pull-right">
             <a href="../imprimerlisteadmis"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-print"></i>Imprimer la liste</button></a>
                
              </div>
</section>
<?php }
else 
{ ?>
  <section class="content">
     <div class="col-md-12">
              
                <!-- /.box-header -->
                <div class="box-body">
                 
                  <div class="alert alert-warning alert-dismissable" style="margin-left: -13px;">
                    
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    Warning alert preview. This alert is dismissable.
                  </div>
                  
               
              </div><!-- /.box -->
            </div>
             <div class="pull-left" style="margin-left: 15px;">
             <a href="../listeadmis"><button class="btn btn-block btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Retour</button></a>
                
              </div>
    </section>
<?php } ?>