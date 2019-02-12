

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
                        <?php for($i=0;$i<count($donne_enCour);$i++): ?>
              <tr>
                <td><?= h($donne_enCour[$i]['type']) ?></td>
                
                <td><?= h($donne_enCour[$i]['nom_fr'].$donne_enCour[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_enCour[$i]['libile'])?></td>
                 <td><?= h($donne_enCour[$i]['created']) ?></td>
                 <td><?= h($donne_enCour[$i]['entreprise']) ?></td>
                  <td> <span class="badge bg-yellow" ><?= h($donne_enCour[$i]['etat']) ?></span></td>
                <td class="actions" style="white-space:nowrap">
                <form action="<?= $this->Url->build(['controller'=>'respostages','action'=>'editCertificatsEtudiants', $donne_enCour["$i"]['id_certif']]); ?>" method="post">
                  <input class="btn btn-block btn-success btn-xs" name="editer" value="Valider" type="submit">
                </form>
                 
                 <form action="<?= $this->Url->build(['controller'=>'respostages','action'=>'cmntCertificatsEtudiants', $donne_enCour["$i"]['id_certif']]); ?>" method="post">
                  <input class="btn btn-block btn-danger btn-xs" name="Rejeter" value="Rejeter" type="submit">
                </form>
                </td>
                 <td>
                <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_enCour["$i"]['id_certif']], ['class'=>'btn btn-block btn-info btn-xs']) ?>
                 <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_enCour[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?>
                </td>

        
              </tr>
            <?php endfor; ?>
          </table>
     