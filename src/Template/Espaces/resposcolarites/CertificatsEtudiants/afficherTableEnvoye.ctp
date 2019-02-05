<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Certificats Etudiants En Attente</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= $this->Paginator->sort('certificat') ?></th>
              
              <th><?= $this->Paginator->sort('Nom') ?></th>
              <th><?= $this->Paginator->sort('Filiere') ?></th>
              <th><?= $this->Paginator->sort('Envoyé') ?></th>
              <th><?= $this->Paginator->sort('Modifié') ?></th>
              <th><?= $this->Paginator->sort('etat') ?></th>
              
              <th><?= $this->Paginator->sort('Commentaire') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            <?php for($i=0;$i<count($donne_demande);$i++): ?>
              <tr>
                <td><?= h($donne_demande[$i]['type']) ?></td>
                
                <td><?= h($donne_demande[$i]['nom_fr'].' '.$donne_demande[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_demande[$i]['libile'])?></td>
                 <td><?= h($donne_demande[$i]['created']) ?></td>
                 <td><?= h($donne_demande[$i]['modified']) ?></td>
                <td> <span class="badge bg-light-blue" ><?= h($donne_demande[$i]['etat']) ?></span></td>
 <td> <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_demande[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?></td>
  <td> <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_demande[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?></td>
 <td> <?= $this->Html->link(__('imprimer'), ['action' => 'comCertificatsEtudiants', $donne_demande[$i]['id_certif']], ['class'=>'btn btn-warning btn-xs']) ?> </td>
                <td class="actions" style="white-space:nowrap">
                <td>
                
                  <form action="<?= $this->Url->build(['controller'=>'Resposcolarites','action'=>'cmntCertificatsEtudiants', $donne_demande[$i]['id_certif']]); ?>" method="post">
                  
                  <input class="btn btn-block btn-danger btn-xs" name="Rejeter" value="Rejeter" type="submit">
                    </form>
                    </td>
                    <td>
                  <form action="<?= $this->Url->build(['controller'=>'Resposcolarites','action'=>'editCertificatsEtudiants', $donne_demande[$i]['id_certif']]); ?>" method="post">
                  
                  <input class="btn btn-block btn-warning btn-xs" name="editer" value="Approuver" type="submit">
                    </form>
                    </td>
                </td>

              </tr>
            <?php endfor; ?>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
             
    </div>
  </div>
</section>