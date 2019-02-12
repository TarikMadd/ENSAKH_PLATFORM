
   
          <table class="table table-hover">
            <tr>
             <th><?= $this->Paginator->sort('certificat') ?></th>
              
              <th><?= $this->Paginator->sort('Nom') ?></th>
              <th><?= $this->Paginator->sort('Filiere') ?></th>
              <th><?= $this->Paginator->sort('Envoyé') ?></th>
              <th><?= $this->Paginator->sort('Entreprise') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              <th><?= __('Actions') ?></th>
              <th><?= __('Plus') ?></th>
            </tr>
            <?php for($i=0;$i<count($donne_prete);$i++): ?>
              <tr>
                <td><?= h($donne_prete[$i]['type']) ?></td>
                
                <td><?= h($donne_prete[$i]['nom_fr'].$donne_prete[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_prete[$i]['libile'])?></td>
                 <td><?= h($donne_prete[$i]['created']) ?></td>
                 <td><?= h($donne_prete[$i]['entreprise']) ?></td>
                <td> <span class="badge bg-green" ><?= h($donne_prete[$i]['etat']) ?></span></td>
 
                <td class="actions" style="white-space:nowrap">
                 <form action="<?= $this->Url->build(['controller'=>'respostages','action'=>'editCertificatsEtudiants', $donne_prete[$i]['id_certif']]); ?>" method="post">
               <input class="btn btn-block btn-success btn-xs" name="editer" value="Délivrer" type="submit">
               </form>
               
                </td>
               <td> <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_prete[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?>
  <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_prete[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?></td>
               
            
              </tr>
            <?php endfor; ?>
          </table>
   