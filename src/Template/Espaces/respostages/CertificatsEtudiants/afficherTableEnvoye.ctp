
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
            <?php for($i=0;$i<count($donne_demande);$i++): ?>
              <tr>
                <td><?= h($donne_demande[$i]['type']) ?></td>
                
                <td><?= h($donne_demande[$i]['nom_fr'].$donne_demande[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_demande[$i]['libile'])?></td>
                 <td><?= h($donne_demande[$i]['created']) ?></td>
                 <td><?= h($donne_demande[$i]['entreprise']) ?></td>
                <td> <span class="badge bg-light-blue" ><?= h($donne_demande[$i]['etat']) ?></span></td>
                 <td>
                <span>
                  <form action="<?= $this->Url->build(['controller'=>'respostages','action'=>'editCertificatsEtudiants', $donne_demande[$i]['id_certif']]); ?>" method="post">
                  
                  <input class="btn btn-primary btn-xs" name="editer" value="Approuver" type="submit">
                  
                    </form>
                </span>
                 <span class="actions" style="white-space:nowrap">
                 <form action="<?= $this->Url->build(['controller'=>'respostages','action'=>'cmntCertificatsEtudiants', $donne_demande["$i"]['id_certif']]); ?>" method="post">
                  <input class="btn btn-block btn-danger btn-xs" name="Rejeter" value="Rejeter" type="submit">
                </form>
                </span>
                </td>
                <td> 
                  
                <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_demande[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?>
  <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_demande[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?>
  <?= $this->Html->link(__('Imprimer'), ['action' => 'imprimerCertificatsEtudiants', $donne_demande[$i]['id_certif']], ['class'=>'btn btn-warning btn-xs' ]) ?> </td>
                
               </tr>
            <?php endfor; ?>
          </table>
     