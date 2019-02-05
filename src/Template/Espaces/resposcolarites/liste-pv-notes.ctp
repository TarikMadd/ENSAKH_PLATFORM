<?php 
// $this->requestAction(array('controller' => 'users', 'action' => 'get_category'));
// http://school.inilabs.net/v2.2/mark/index
//echo '<pre>';
//print_r($rows);
//echo '</pre>';
//die();
?>
<section class="content">
    

                    <!-- datatable note start -->
                    
                    <div class="row">
                        
                        <div class="col-xs-12"><!--
                             <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nombre des etudients que vous enseigner :  <?php //echo count($etudiants) ?></h3>
                </div> /.box-header 

                 </div> /.box -->
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title">Liste des changement </h3>
                              <?php if(isset($message) != null && $message != null) :?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                                    <?php echo $message; ?>
                                </div>
                              <?php endif ?>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                            
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                      <tr>
                                  <th>CNE</th>
                                  <th>NOM</th>
                                  <th>PRENOM</th>
                                  <th>NOTE OLD</th>
                                  <th>NOTE NEW</th>
                                  <th>NIVEAU</th>
                                  <th>FILIERE</th>
                                  <th>DATE</th>
                                </tr>
                    </thead>
                                  <tbody>
                            <?php if(isset($pvs) != null && $pvs != -1) :?>
                                <?php foreach ($pvs as $pv): ?>
                                        <tr>
                                            <td><?php echo $pv['cne']; ?></td>
                                            <td><?php echo $pv['nom_fr']; ?></td>
                                            <td><?php echo $pv['prenom_fr']; ?></td>
                                            <td><?php echo $pv['note_old']; ?></td>
                                            <td><?php echo $pv['note']; ?></td>
                                            <td><?php echo $pv['lib_f']; ?></td>
                                            <td><?php echo $pv['lib_n']; ?></td>
                                            <td><?php echo $pv['date_update']; ?></td>
                                        </tr>
                                        
                                    <?php endforeach; ?>
                            <?php endif ?>
</tbody><tfoot>
                      <tr>
                        <th>CNE</th>
                                  <th>NOM</th>
                                  <th>PRENOM</th>
                                  <th>NOTE OLD</th>
                                  <th>NOTE NEW</th>
                                  <th>NIVEAU</th>
                                  <th>FILIERE</th>
                                  <th>DATE</th>
                      </tr>
                    </tfoot></table>
                            
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                        </div>
                        
                      </div>
                    <!-- end datatable note -->
                    
                   
    
</section>
