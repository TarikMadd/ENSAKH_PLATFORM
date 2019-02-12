
          <table class="table table-hover">
            <tr>
             <th><?= $this->Paginator->sort('certificat') ?></th>
              
              <th><?= $this->Paginator->sort('Nom') ?></th>
              <th><?= $this->Paginator->sort('Filiere') ?></th>
              <th><?= $this->Paginator->sort('Envoyé') ?></th>
              <th><?= $this->Paginator->sort('Entreprise') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
            
              <th><?= __('Plus') ?></th>
            </tr>
            <?php for($i=0;$i<count($donne_delivrer);$i++): ?>
              <tr>
                <td><?= h($donne_delivrer[$i]['type']) ?></td>
                
                <td><?= h($donne_delivrer[$i]['nom_fr'].$donne_delivrer[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_delivrer[$i]['libile'])?></td>
                 <td><?= h($donne_delivrer[$i]['created']) ?></td>
                 <td><?= h($donne_delivrer[$i]['entreprise']) ?></td>
                <td> <span class="badge bg-navy" ><?= h($donne_delivrer[$i]['etat']) ?></span></td>
  <td> <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_delivrer[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?>
  <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_delivrer[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?></td>

              </tr>
            <?php endfor; ?>
          </table>
          
          <ul class="pagination pagination-sm no-margin pull-right">
           
          </ul>
         
       