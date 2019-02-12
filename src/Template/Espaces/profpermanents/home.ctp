<?php echo $this->Html->css('teacher'); ?>
    <?php
        if($box_msg_note != null){
        $sum_reste_a_saisir = 0;
        foreach ($box_msg_note as $box_msg) : ?>
        <?php $sum_reste_a_saisir += $box_msg['reste_saisir']; ?>            
        <?php endforeach; }?>
<section class="content">
    <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $data['STUDENT_NBR'][0]['student_nbr'] ?></h3>
                  <p>Etudiants</p>
                </div>
                <div class="icon">
                  <i class="fa fa-mortar-board"></i>
                </div>
                <a href="<?php 
                    echo $this->Url->build([
                        "controller" => "Profpermanents",
                        "action" => "showStudentDetail"
                    ]);
                  ?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $data['ELEMENT_NBR'][0]['elements_nbr'] ?></h3>
                  <p>Éléments</p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo count($data['CLASSES_NBR']); ?></h3>
                  <p>Classes</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-blackboard"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php if(isset($sum_reste_a_saisir) && $sum_reste_a_saisir != null){echo $sum_reste_a_saisir;}else{ echo 0;} ?></h3>
                  <p>Reste à saisir</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
          </div>
    
    <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username"> <?php echo $data['PROF_DATA'][0]['nom_prof'].' '.$data['PROF_DATA'][0]['prenom_prof']; ?> </h3>
              <h5 class="widget-user-desc">Prof permanent</h5>
            </div>
            <div class="widget-user-image">
                <?php echo $this->Html->image('teacher.png', array('alt' => 'teacher', 'class'=> 'img-circle')); ?>
            </div>

            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a href="#">Somme <span class="pull-right badge bg-blue"><?php echo $data['PROF_DATA'][0]['somme']?></span></a></li>
                  <li><a href="#">Email <span class="pull-right badge bg-aqua"><?php echo $data['PROF_DATA'][0]['email_prof']?></span></a></li>
                  <li><a href="#">Phone <span class="pull-right badge bg-green"><?php echo $data['PROF_DATA'][0]['phone']?></span></a></li>
                  <li><a href="#">CIN <span class="pull-right badge bg-green"><?php echo $data['PROF_DATA'][0]['CIN']?></span></a></li>
                  <li><a href="#">cadre <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['cadre']?></span></a></li>
                  <li><a href="#">grade <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['sous_grade']?></span></a></li>
                  <li><a href="#">echelon <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['echelon']?></span></a></li>
                  <li><a href="#">Date prochain echelon <span class="pull-right badge bg-red"><?php echo $data['PROF_GRADE'][0]['date_next_echelon']?></span></a></li>
                
                </ul>
              </div>
          </div><!-- /.widget-user -->
        </div><!-- /.col -->
        
        <!--  Notifications table  -->
        <div class="col-xs-12" style="width : 66.4444444444%">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title" >Element serte à saisir</h3>
                  <div class="box-tools">
<!--                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody>   
                    <tr>
                      <th>niveaux</th>
                      <th>filière</th>
                      <th>module</th>
                      <th>élément</th>
                      <th>reste à saisir</th>
                    </tr>
                    <?php if(isset($box_msg_note) && $box_msg_note!= null): ?>
                        <?php foreach ($box_msg_note as $box_msg) : ?>
                        <tr>
                          <td><?php echo $box_msg['nivaux']; ?></td>
                          <td><?php echo $box_msg['feliere']; ?></td>
                          <td><?php echo $box_msg['modele']; ?></td>
                          <td><?php echo $box_msg['element']; ?></td>
                          <td><span class="label label-success"><?php echo $box_msg['reste_saisir']; ?></span></td>    
                        </tr>
                        <?php endforeach; ?>
                    <?php endif ?>
                    </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        <!-- End notificatio's table -->
    </div>
    
    <div class="row">
        <?php if($full_data != null) : ?>
            <?php foreach ($full_data as $data): ?>
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-yellow">
                        <div class="widget-user-image">
                          <?php 
                            switch ($data['classes']['feliere_lib']) {
                                case "GI":
                                    echo $this->Html->image('file.png', array('alt' => 'GI', 'class'=> 'img-circle')); 
                                    break;
                                case "GE":
                                    echo $this->Html->image('light-bulb.png', array('alt' => 'GE', 'class'=> 'img-circle')); 
                                    break;
                                case "GPE":
                                    echo $this->Html->image('flask.png', array('alt' => 'GPE', 'class'=> 'img-circle')); 
                                    break;
                                case "GRT":
                                    echo $this->Html->image('networking.png', array('alt' => 'GRT', 'class'=> 'img-circle')); 
                                    break;
                                default:
                                    echo $this->Html->image('protractor.png', array('alt' => 'other', 'class'=> 'img-circle')); 
                                    break;
                            }
                          ?>
                        </div><!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><?php echo $data['classes']['nivaux_lib']; ?></h3>
                        <h5 class="widget-user-desc"><?php echo $data['classes']['feliere_lib']; ?></h5>
                      </div>
                      <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <?php foreach ($data['classes']['modeles'] as $modele) : ?>
                            <form action="/Ensaksite/profpermanents/verifier-code" method="POST">
                                <input type="hidden" value="<?php echo $data['classes']['class_id']; ?>" name="class_id" />
                                <input type="hidden" value="<?php echo $modele['id']; ?>" name="module_id" />
                            <li><button type="submit" style="background-color: #fff; border-color: #fff; border-bottom-color: #ddd; " class="btn btn-default btn-block"><?php echo $modele['libile'] ;?><span class="pull-right badge bg-blue"></span></button></li>
                            </form>
                                <?php foreach($modele['elements'] as $element) : ?>
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo $element['code'] ;?></h5>
                                            <span class="description-text">code</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo $element['libile'] ;?></h5>
                                            <span class="description-text">ÉTIQUETTE</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div  class="col-sm-4">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo $element['Eval'] ;?></h5>
                                            <span class="description-text">Eval</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo $element['nbr'][0]['nombre_etudiants'] ;?></h5>
                                            <span class="description-text">NOMBRE D'ÉTUDIANT</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo $element['nbr_note'][0]['nbr_etudiant_note'] ;?></h5>
                                            <span class="description-text">ÉTUDIANT AVEC NOTE</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo $reste = $element['nbr'][0]['nombre_etudiants'] - $element['nbr_note'][0]['nbr_etudiant_note'] ;?></h5>
                                            <span class="description-text">ÉTUDIANTS RESTE</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                    </div>
                                    <div style="border-bottom: 1px solid #f4f4f4;" class="row">
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo number_format((float)$element['nbr_mma'][0]['note_max'], 2, '.', ''); ?></h5>
                                            <span class="description-text">Note Maximale</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo number_format((float)$element['nbr_mma'][0]['note_min'], 2, '.', ''); ?></h5>
                                            <span class="description-text">Note minimale</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                        <div class="col-sm-4">
                                          <div class="description-block">
                                            <h5 class="description-header"><?php echo number_format((float)$element['nbr_mma'][0]['note_moyen'], 2, '.', ''); ?></h5>
                                            <span class="description-text">Moyenne</span>
                                          </div><!-- /.description-block -->
                                        </div><!-- /.col -->
                                    </div>
                                        
                                <?php endforeach ?>
                            <?php endforeach; ?>
                        </ul>
                      </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->
            <?php endforeach; ?>
        <?php endif ?> 
    </div>
</section>

