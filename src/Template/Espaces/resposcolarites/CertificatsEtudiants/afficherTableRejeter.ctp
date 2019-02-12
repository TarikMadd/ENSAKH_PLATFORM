<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Certificats Etudiants Rejeter</h3>
          
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
            <?php for($i=0;$i<count($donne_rejeter);$i++): ?>
              <tr>
                <td><?= h($donne_rejeter[$i]['type']) ?></td>
                
                <td><?= h($donne_rejeter[$i]['nom_fr'].' '.$donne_rejeter[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_rejeter[$i]['libile'])?></td>
                 <td><?= h($donne_rejeter[$i]['created']) ?></td>
                 <td><?= h($donne_rejeter[$i]['modified']) ?></td>
                <td> <span class="badge bg-red" ><?= h($donne_rejeter[$i]['etat']) ?></span></td>
  <td> <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_rejeter[$i]['id_certif']], ['class'=>'btn btn-block btn-info btn-xs']) ?></td>
  <td> <?= $this->Html->link(__('Afficher'), ['action' => 'viewCertificatsEtudiants', $donne_rejeter[$i]['id_certif']], ['class'=>'btn btn-block btn-info btn-xs']) ?></td>

              </tr>
            <?php endfor; ?>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>
             
    </div>
  </div>
</section>