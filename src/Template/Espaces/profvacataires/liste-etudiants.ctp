<?php 
// $this->requestAction(array('controller' => 'users', 'action' => 'get_category'));
// http://school.inilabs.net/v2.2/mark/index
//echo '<pre>';
//print_r($rows);
//echo '</pre>';
//die();
?>
<section class="content">
    <div id="header_botton" class="row">
        <div class="col-md-6" style="width: 100% !important; margin-left: 0 !important; margin-bottom: 10px;">
           
                <form method="POST" action="showElement">
                    <button style=" background-color: #fff; margin-bottom: 2px; " type="submit" class="btn btn-block btn-default">Liste Element</button>
                </form>
                <form method="POST" action="showModel">
                        <button style=" background-color: #fff;  margin-bottom: 2px;" type="submit" class="btn btn-block btn-default">Liste Module</button>
                </form>
                
        </div>
    </div>
    <div  class="row">
        
        <div  class="col-md-6" style="width: 100% !important; margin-left: 0 !important;">
            <?php echo $this->Html->image('2017-02-28_173811.png', array('alt' => 'teacher', 'style'=>' width: 100%;', 'id'=> 'ensa_img')); ?>
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div id="main_table" class="box-header with-border">
                    <h3 class="box-title">Niveau  : <?php echo $semestre[0]['niveaus_lib']; ?>
                                <br/><br> Filiere : <?php echo $semestre[0]['filieres_lib']; ?><br/><br>
                                          Element : <?php echo $etudiants[0]['libile']; ?>      
                    </h3>
                    <h3 class="box-title txt-annee" style="float: right;" >ANNEE UNIVERSITAIRE : <?php echo $anneeScolaire[0]['libile']; ?><br/><br/><span style="float: right" ><?php echo ' SEMESTRE : '.$semestre[0]['semestres_lib']; ?></span></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="ajouter-notes" enctype='multipart/form-data'>
                  
                    
                    <!-- datatable note start -->
                    
                    <div class="row">
                        <div class="col-xs-12">
                          <div class="box">
                            <div class="box-header">
                              <h3 class="box-title">Liste des etudiants </h3>
                              <?php if(isset($message) != null && $message != null) :?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                                    <?php echo $message; ?>
                                </div>
                              <?php endif ?>
                              
                              <div id="search_box" style=" float: right; width: 25%; " class="input-group input-group-sm">
                              <select onchange="this.form.submit()" name="orderBy" class="form-control" style=" width: 100%; float: right; ">
                                  <option disabled selected>Filter par : </option>
                                  <option value="cne" >CNE</option>
                                  <option value="nom_fr">Nom</option>
                                  <option value="note">Note</option>
                                  <option value="confirmed">Confirmer</option>
                                    </select><span class="input-group-btn">Filtrer Par :
                                        <input type="hidden" name="action" value="order" class="btn btn-info btn-flat" />
                    </span></div>
                            </div><!-- /.box-header -->
                            
                            <div id="table_content" class="box-body table-responsive no-padding">
                            
                                <table  class="table table-hover">
                                <tbody><tr>
                                  <th>CNE</th>
                                  <th>Nom</th>
                                  <th>Prenom</th>
                                  <th>Note</th>
                                  <th>Confermed</th>
                                  <th>Saved</th>
                                  <th>Note Ratt</th>
                                  <th>Confermed</th>
                                  <th>Saved</th>
                                  <th>Inséré le </th>
                                  <th>Mis à jour le</th>
                                </tr>
                                <!-- Strat First Time -->
                                <?php $i = 0 ;?>
                                <input type="hidden" value="<?php echo $etudiants[0]['element_id']; ?>" name="element_id" />
                                <?php if ($first_time):  ?>
                                <input type="hidden" value="insert" name="query" />
                                <input type="hidden" value="<?php echo count($etudiants); ?>" name="lenght" />
                                    <?php foreach ($etudiants as $element): ?>
                                        <tr>
                                        <input type="hidden" value="<?php echo $element['etudier_id'] ?>" name="etudiant_<?php echo $i; ?>" />
                                            <td><?php echo $element['cne']; ?></td>
                                            <td><?php echo $element['nom_fr']; ?></td>
                                            <td><?php echo $element['prenom_fr']; ?></td>
                                            <?php if($access_type === "consulter") : ?>
                                                <td></td>
                                            <?php else :?>
                                                <td>
                                                    <div class="col-xs-3" style="width: 80%;">
                                                        <input id="note_input" type="text" pattern="[0-9]+([\.][0-9]+)?" step="0.01"
                                                               title="Cela devrait être un nombre avec jusqu\'à 2 décimales exemple : (16.75)." maxlength="5" class="form-control" value=""  name="note_<?php echo $i; ?>">
                                                    </div>
                                                </td>
                                            <?php endif ?>
                                            <td><span class="label label-danger">not confirmed</span></td>
                                            <td><span class="label label-danger">not saved</span></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                
                                <!-- End First Time -->
                                
                                
                                
                                <?php else : ?>
                                <?php $haveMore = false ?>
                                <input type="hidden" value="update" name="query" />
                                <input type="hidden"  value="<?php echo count($etudiants); ?>" name="lenght" />
                                    <?php foreach ($etudiants as $element): ?>
                                        <tr>
                                        <input type="hidden" value="<?php echo $element['id'] ?>" name="etudiant_<?php echo $i; ?>" />
                                        <td><?php echo $element['cne']; ?></td>
                                        <td><?php echo $element['nom_fr']; ?></td>
                                        <td><?php echo $element['prenom_fr']; ?></td>
                                        <?php 
                                            if ($element['confirmed'] && ($for_pv == 0 || $for_ratt == 1)) {
                                                echo '<td>'.$element['note'].'</td>';
                                            }
                                            else{
                                                if($access_type === "consulter"){
                                                    echo '<td>'.$element['note'].'</td>';
                                                }else{
                                                    echo    '<td> <div class="col-xs-3" style="width: 80%;">'
                                                              . '<input id="note_input" pattern="[0-9]+([\.][0-9]+)?" step="0.01" title="Cela devrait être un nombre avec jusqu\'à 2 décimales exemple : (16.75)." type="text" maxlength="5" class="form-control" value="'.$element['note'].'"  name="note_'.$i.'">'
                                                          . '</div>'
                                                      . '</td>';
                                                }
                                            }
                                          ?>
                                          <?php 
                                           if ($element['confirmed']) {
                                               echo '<td><span class="label label-success">confermed</span></td>';
                                           }
                                           else{
                                               echo '<td><span class="label label-danger">not confirmed</span></td>';
                                           }
                                           if($element['saved']){
                                               echo '<td><span class="label label label-success">saved</span></td>';
                                           }
                                           else{
                                               echo '<td><span class="label label-danger">not saved</span></td>';
                                           }
                                         ?>
                                        <?php 
                                        if ($element['confirmed'] && $element['ratt_confirmed'] && $for_pv == 0) {
                                            echo '<td>'.$element['note_ratt']; '</td>';
                                        }
                                        else if (!$element['confirmed']) {
                                            echo '<td></td>';
                                        }
                                        else if($element['note'] >= 12){
                                            echo '<td></td>';
                                        }
                                        else{
                                            if($for_ratt){
                                                if($access_type === "consulter"){
                                                    echo '<td></td>';
                                                }
                                                else{
                                                    echo    '<td> <div class="col-xs-3" style="width: 80%;">'
                                                            . '<input id="note_input" pattern="[0-9]+([\.][0-9]+)?" step="0.01" title="Cela devrait être un nombre avec jusqu\'à 2 décimales exemple : (16.75)." type="text" maxlength="5" class="form-control" value="'.$element['note_ratt'].'" name="ratt_note_'.$i.'" >'
                                                            . '</div>'
                                                            . '</td>';
                                            
                                                }
                                            }
                                            else
                                                echo '<td></td>';
                                        }
                                        ?>
                                      <?php 
                                        if($element['note'] < 12){
                                            if ($element['ratt_confirmed']) {
                                                echo '<td><span class="label label-success">confermed</span></td>';
                                            }
                                            else{
                                                echo '<td><span class="label label-danger">not confirmed</span></td>';
                                            }
                                            if($element['ratt_saved']){
                                                echo '<td><span class="label label label-success">saved</span></td>';
                                            }
                                            else{
                                                echo '<td><span class="label label-danger">not saved</span></td>';
                                            }
                                        }
                                        else{
                                            echo '<td></td>';
                                            echo '<td></td>';   
                                        }
                                        echo '<td>'.$element['created_at']; '</td>';
                                        echo '<td>'.$element['updated_at']; '</td>';
                                      ?>
                                        
                                    </tr>
                                    <?php $i++ ?>
                                    <?php 
                                        if (!$haveMore) {
                                            if (!$element['confirmed']) {
                                                $haveMore = true;
                                            }
                                            else if($element['note'] < 12 && !$element['ratt_confirmed'] && $for_ratt){
                                                $haveMore = true;
                                            }
                                        }
                                    ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                              </tbody></table>
                                
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
            
                            
                                
                            <?php
                            if((isset($haveMore) && $haveMore) || !isset($haveMore) || $for_pv == 1){
                                if($access_type !== "consulter")  {
                                    echo '<label class="btn btn-default btn-file" style=" margin-left: 10px; ">';
                                        echo 'Browse <input name="csv_notes" type="file" hidden>';
                                    echo '</label>';
                                    if($first_time){
                                        echo '<button id="save" style="margin-right: 10px;margin-bottom: 20px;position: absolute;margin-left: 10px;" name="action"  value="insert_csv" type="submit" class="btn btn-info pull-right">upload notes</button>';
                                    }
                                    else{
                                        echo '<button id="save" style="margin-right: 10px;margin-bottom: 20px;position: absolute;margin-left: 10px;" name="action" value="update_csv"  type="submit" class="btn btn-info pull-right">upload notes</button>';
                                    }
                                }
                            }
                            ?>
<!--                              <small style="margin-left: 120px;">Vous pouvez inserer les notes plus de <a href="#">detail</a></small>
                         -->
                         <?php $imprimer = true; foreach ($etudiants as $element): ?>
                    <?php 
                        if($first_time){
                           $imprimer = false; 
                        }
                        else if (!$element['confirmed']) {
                            $imprimer = false;
                        }
                    ?>
                <?php endforeach; ?>
                <?php if($imprimer) : ?>
                    <button style=" margin-right: 10px; margin-bottom: 20px; " id="impression" name="impression" class="btn btn-warning pull-right">  Imprimer PDF </button> 
                <?php else : echo '<br/>'; ?>
                <?php endif ?>
                            <?php if($imprimer) : ?>
                                <button id="exporter" style=" margin-right: 10px; margin-bottom: 20px; " value="export" name="action" type="submit" class="btn btn-warning pull-right">  Exporter CSV  </button>
                                <textarea style="display:none;" name="html_content" id="html_content_input"></textarea>
                                <button id="exporter_html" style=" margin-right: 10px; margin-bottom: 20px; " value="save_html"  name="action" type="submit" class="btn btn-warning pull-right">  Exporter HTML </button>
                            <?php endif ?>
                        <?php if((isset($haveMore) && $haveMore) || !isset($haveMore) || $for_pv == 1) : ?>
                            <?php if($access_type !== "consulter") : ?>
                                <button id="confirmer" style=" margin-right: 10px; margin-bottom: 20px; " name="action" value="confirme"  type="submit" class="btn btn-warning pull-right">confirmer</button>
                                <?php if(!$for_pv): ?>
                                    <button id="save" style=" margin-right: 10px; margin-bottom: 20px; " name="action" value="save" type="submit" class="btn btn-info pull-right">save</button>
                                <?php endif ?>
                            <?php endif ?>
                        <?php endif ?>
                        
                        </div>
                        
                      </div>
                    <!-- end datatable note -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.box-footer -->
    </div>

    
   
</section>
