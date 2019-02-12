
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
            <?php for($i=0;$i<count($donne_rejeter);$i++): ?>
              <tr>
                <td><?= h($donne_rejeter[$i]['type']) ?></td>
                
                <td><?= h($donne_rejeter[$i]['nom_fr'].$donne_rejeter[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_rejeter[$i]['libile'])?></td>
                 <td><?= h($donne_rejeter[$i]['created']) ?></td>
                 <td><?= h($donne_rejeter[$i]['entreprise']) ?></td>
                <td> <span class="badge bg-red" ><?= h($donne_rejeter[$i]['etat']) ?></span></td><td> <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_rejeter[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?>
  <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_rejeter[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?></td>

              </tr>
            <?php endfor; ?>
          </table>
        