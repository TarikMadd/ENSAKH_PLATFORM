<table id="example1" class="table table-bordered table-striped">
                <thead>
              <tr>
                <th><?= $this->Paginator->sort('certificat') ?></th>
                <th><?= $this->Paginator->sort('Envoyé') ?></th>
                <th><?= $this->Paginator->sort('Modifié') ?></th>
                <th><?= $this->Paginator->sort('etat') ?></th>
                <th><?= $this->Paginator->sort('commentaire') ?></th>
                <th><?= __('Actions') ?></th>
              </tr>
                </thead>
                <tbody>
                <?php foreach ($certificatsEtudiants as $certificatsEtudiant): ?>
              <tr>
                <td><?= h($certificatsEtudiant->certificat->type) ?></td>
                <td><?= h($certificatsEtudiant->created) ?></td>
                <td><?= h($certificatsEtudiant->modified) ?></td>
                <td><?php switch ($certificatsEtudiant->etat){
                            case 'Rejeter' : 
                            echo "<span class=\"badge bg-red \" >";
                            break;
                            case 'En cours de traitement' : 
                            echo "<span class=\"badge bg-yellow\" >";
                            break;
                            case 'Demande envoyé' : 
                            echo "<span class=\"badge bg-light-blue\" >";
                            break;
                            case 'Prête' : 
                            echo "<span class=\"badge bg-green\" >";
                            break;
                            case 'Délivré' : 
                            echo "<span class=\"badge bg-navy\" >";
                            break;
                 } 
                 echo h($certificatsEtudiant->etat);
                 ?></td>              
                <td><?=h($certificatsEtudiant->commentaire)?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Form->postLink(__('Annuler'), ['conroller'=>'Etudiants','action' => 'deleteCertificats', 
                  $certificatsEtudiant->id], ['confirm' => __('Etes vous sures d\'annuler ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
                </tbody>
              </table>