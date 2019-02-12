

<?php
/**
  * @var \App\View\AppView $this
  */
?>
 <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Resultat de la recherche') ?> </h3>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
  
                <span class="input-group-btn">
    
        
                </span>
              </div>
            </form>
          </div>
        </div>
 
 
 <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>

          
                 <th><?= $this->Paginator->sort('Numéro Enregitrement') ?></th>
              <th><?= $this->Paginator->sort('date_arrivee') ?></th>
              <th><?= $this->Paginator->sort('Désignation') ?></th>
              <th><?= $this->Paginator->sort('expediteur') ?></th>
              <th><?= $this->Paginator->sort('nom_service') ?></th>

              <th><?= $this->Paginator->sort('type_courrier') ?></th>
              <th><?= $this->Paginator->sort('nécessité_du_traitement') ?></th>

              <th><?= $this->Paginator->sort('Priorité') ?></th>
              <th><?= $this->Paginator->sort('date_limite_du_traitement') ?></th>
               <th><?= $this->Paginator->sort('etat_du_courrier') ?></th>
              <th><?= $this->Paginator->sort('Courrier') ?></th>
              <th><?= $this->Paginator->sort('Accusé de reception') ?></th>
              <th><?= $this->Paginator->sort('Courrier_retourne') ?></th>
              <th>Actions</th>
            </tr>
        </thead>
        <tbody>
              
             <?php  for ($i=0;$i<count($courrierArrivees);$i++ ): ?>
              <tr>
                <td><?= h($courrierArrivees[$i]['id']) ?></td>
                <td><?= h($courrierArrivees[$i]['date_arrivee']) ?></td>
                <td><?= h($courrierArrivees[$i]['Désignation']) ?></td>
                <td> <?= h($courrierArrivees[$i]['nomComplet_expediteur']) ?> </td>
                 
                <td> <?php if($courrierArrivees[$i]['service_id']!= NULL): ?>
                <?= h($services[$courrierArrivees[$i]['service_id']]) ?>
              <?php endif; ?>
                 </td>
                 
                <td><?= h($courrierArrivees[$i]['type_courrier']) ?></td>
                <td><?= h($courrierArrivees[$i]['necessité_du_traitement']) ?></td>

            

        
<?php if( h($courrierArrivees[$i]['Priorité'])=="Urgent")
                { echo'<td> 
                <span class="badge bg-yellow" >';?> <?= h($courrierArrivees[$i]['Priorité']) ?> 
                <?php echo '</span></td>'; }
                elseif (h($courrierArrivees[$i]['Priorité'])=="Normal") 
                {
                 echo'<td> <span class="badge bg-green" >';?> <?= h($courrierArrivees[$i]['Priorité']) ?><?php echo '</span></td>'; }
                elseif (h($courrierArrivees[$i]['Priorité'])=="aucun") 
                {
                 echo'<td> </td>'; }
                 elseif (h($courrierArrivees[$i]['Priorité'])=="Très urgent")
                {
                echo' <td> <span class="badge bg-red" >'; ?> <?= h($courrierArrivees[$i]['Priorité']) ?><?php echo '</span></td>'; }
                else{
                  echo' <td> '; ?> <?= h($courrierArrivees[$i]['Priorité']) ?><?php echo '</td>'; 
                }
                  
                ?>
             <td><?= h($courrierArrivees[$i]['date_limite_du_traitement']) ?></td>
<?php if( h($courrierArrivees[$i]['etat_du_courrier'])!="-")
                { 
                  echo'<td> 
                  <span class="badge bg-yellow" >';echo $courrierArrivees[$i]['etat_du_courrier'];?>  
                  <?php echo '</span></td>'; }
                  else {echo'<td>'. h($courrierArrivee[$i]['etat_du_courrier']) .'</td>';}
                  ?>
                <td class="actions" style="white-space:nowrap">
                <?php if($courrierArrivee[$i]['courrier']!=""): ?> 
                  <?= $this->Html->link(__('Télecharger'), ['action' => 'download', $courrierArrivee[$i]['id']], ['class'=>'fa fa-download']) ?>

                
                   <a href="<?php echo $this->Url->build('/courrier/'.$courrierArrivee[$i]['courrier'].''); ?>" target="_blank" class="btn bg-navy margin">afficher</a>
               <?php endif;?>
                </td>
                <td class="actions" style="white-space:nowrap">
                <?php if($courrierArrivee[$i]['accuse']!=""): ?> 
                  <?= $this->Html->link(__('Télecharger'), ['action' => 'downloadAcc', $courrierArrivee[$i]['id']], ['class'=>'fa fa-download']) ?>
                  <a href="<?php echo $this->Url->build('/courrier/'.$courrierArrivee[$i]['accuse'].''); ?>" target="_blank" class="btn bg-navy margin">afficher</a>
                   <?php endif;?>
                </td>
                <?php if($courrierArrivees[$i]['courrier_retourne']  =="Oui")
                {
                  echo'<td> 
                <span class="badge bg-red" >';echo $courrierArrivee[$i]['courrier_retourne']?> 
                <?php echo '</span></td>'; }
                else
                  echo'<td>'. $courrierArrivees[$i]['courrier_retourne'] .'</td>';

                 ?>
         

<td class="actions" style="white-space:nowrap">
                    <p>
                      <span style="inline;">
                       <?php if($courrierArrivees[$i]['etat_du_courrier'] =="en attente"): ?>
                        <form action="<?= $this->Url->build(['action'=>'updateEtat', $courrierArrivees[$i]['id']]); ?>" method="post">
                          
                          <input class="btn btn-primary btn-xs" name="editer" value="Approuver" type="submit">
                          
                        </form>
                      <?php endif;?>
                      <?php if($courrierArrivees[$i]['etat_du_courrier'] =="en cours de traitement"): ?>
                        <form action="<?= $this->Url->build(['action'=>'updateEtat', $courrierArrivees[$i]['id']]); ?>" method="post">
                          
                          <input class="btn btn-success btn-xs" name="editer" value="Valider" type="submit">
                          
                        </form>
                      <?php endif;?>
                      
                      <?= $this->Html->link(__('Voir'), ['action' => 'viewArrivee', $courrierArrivees[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Editer'), ['action' => 'editArrivee', $courrierArrivees[$i]['id']], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteArrivee', $courrierArrivees[$i]['id']], ['confirm' => __('Voulez-vous supprimer cet expediteur ? '), 'class'=>'btn btn-danger btn-xs']) ?>
                    </span>
                  </p>
                  
                </td>

      
 
        
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
  
 
</div>
</section>




