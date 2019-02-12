<section class="content">
 <?php 
        if($_SESSION['isdemande']=='no')
        { ?>
            <div class="alert alert-warning alert-dismissable">
                    
                    <h4><i class="icon fa fa-warning"></i> Pas de demandes à traiter !</h4>
                    
            </div>
        <?php 
        }
        else
        { ?>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Demandes abscences déposées :</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                            <th>#</th>
                            <th><?= $this->Paginator->sort('Id') ?></th>
                            <th><?= $this->Paginator->sort('Durée absence') ?></th>
                            <th><?= $this->Paginator->sort('Cause absence') ?></th>
                            <th><?= $this->Paginator->sort('Date absence') ?></th>
                            <th><?= $this->Paginator->sort('Heure absence') ?></th>
                            <th><?= $this->Paginator->sort('Etat absence') ?></th>
                            <th></th>
                    </tr>
                   <?php $i=1;
                   foreach ($_SESSION['demandes'] as $demande) 
                   { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                  <td><?php echo $demande['id'];?></td>
                  <td><?php echo $demande['duree_ab']." jour(s)";?></td>
                  <td><?php echo $demande['cause'];?></td>
                  <td><?php echo $demande['date_ab'];?></td>
                  <td><?php echo $demande['time_ab'];?></td>
                  <td>
                    <?php
                       if($demande['isvalid']==0){
                        echo "En cours de traitement";
                       }
                       if($demande['isvalid']==1){
                        echo "Acceptée";
                       }
                       if($demande['isvalid']==2){
                        echo "Refusée";
                       }
                    ?>
                  </td>
                  <td><?php
                         if($demande['isvalid']==1){
                          echo $this->Html->link(__('Imprimer'), ['action' => 'Imprimer',$demande['id']], ['class'=>'btn btn-warning btn-xs']  ) ;
                         }
                      ?>
                  </td> 
                  </tr>
         
                  <?php $i++;}
                   ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
  </div>
        <?php 
        } ?>

</section>