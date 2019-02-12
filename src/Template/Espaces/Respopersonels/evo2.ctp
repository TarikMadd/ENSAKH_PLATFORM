<section class="content">
    <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">les grades des fonctionnaires</h3>
                  <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="somme" class="form-control" placeholder="<?= __('chercher un fonctionnaire et ses grades') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"> Rechercher </button>
                   </span>
              </div>
            </form>
          </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table ALIGN=center style="text-align: center;vertical-align: middle;" class="table table-bordered">
                    <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Grade</th>
                      
                      <th>Categorie</th>
                      
                      <th>Date debut</th>
                      

                    
                    <tr>
                      <?php
                        for($l=0;$l< count($fonctionnaireG);$l++)
                        {
                          if($l==0) : ?>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['fonctionnaire_id']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['nom_fct']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['prenom_fct']?></td>
                           
                          <?php elseif($fonctionnaireG[$l]['fonctionnaire_id'] != $fonctionnaireG[$l-1]['fonctionnaire_id']): ?>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['fonctionnaire_id']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['nom_fct']?></td>
                              <td rowspan = <?= $nombre[$fonctionnaireG[$l]['fonctionnaire_id']] ?>><?php echo $fonctionnaireG[$l]['prenom_fct']?></td>
                          <?php endif; ?>
                        <td><span class="badge bg-yellow"><?php echo $fonctionnaireG[$l]['nomGrade']?></span></td>
                        
                      
                        <td><?php echo $fonctionnaireG[$l]['categorie']?></td>
                        <td><?php echo $fonctionnaireG[$l]['date_grade']?></td>
                        
                        

              
                      </tr>  <?php } ?>
                    
                    
                  </table>
                </div><!-- /.box-body -->
                
              </div>


</section>