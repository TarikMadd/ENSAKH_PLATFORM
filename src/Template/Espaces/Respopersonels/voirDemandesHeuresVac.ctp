<section class="content">
 <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Les demandes de modifications des données envoyées par les professeurs vacataires </h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Nom et prénom </th>
                      <th>Nombre d'heures</th>
              <th><?= $this->Paginator->sort('dateInsertion') ?></th>
                     <th><?= $this->Paginator->sort('etat') ?></th>

                      <th>Action</th>
                    </tr>
                   <?php $i=0;
                   foreach ($profvac as $profvacbi) 
                   { ?>
               		<tr>
               			<td><?php echo $i;?></td>
               		<td><?= h($profvacbi->vacataire->somme)?></td>
               		<td><?php echo $profvacbi['nbHeure'];?></td>
               		
                    <td><?php echo $profvacbi['dateInsertion'];?></td>
                                        <td><?= h($profvacbi->etat) ?></td>
                        
               		<td><?php if(strcmp($profvacbi->etat, 'non validé') == 0)
                                                 {
                       echo $this->Html->link(__('Valider'), ['action' => 'validerHeuresVac', $profvacbi->id,$profvacbi->vacataire_id], ['class'=>'btn btn-info btn-xs']  ); }
                        elseif($profvacbi->etat =='Validé') {
                            echo $this->Html->link(__('Afficher'), ['action' => 'viewvacatairre', $profvacbi->vacataire_id], ['class'=>'btn btn-info btn-xs']  ); }
                        
                       /*<a href="validerDonneesVac/<?php echo $profvacbi['id'];?>"> <span class="btn btn-info btn-flat">Traiter</span></a></td>*/
                       ?>
                       </tr>


                  <?php $i++;}
                   ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
	
</section>