<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('List of') ?> Certificats Etudiants Validés </h3>
          
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
            <?php for($i=0;$i<count($donne_prete);$i++): ?>
              <tr>
                <td><?= h($donne_prete[$i]['type']) ?></td>
                
                <td><?= h($donne_prete[$i]['nom_fr'].' '.$donne_prete[$i]['prenom_fr']) ?></td>
                <td><?= h($donne_prete[$i]['libile'])?></td>
                 <td><?= h($donne_prete[$i]['created']) ?></td>
                 <td><?= h($donne_prete[$i]['modified']) ?></td>
                <td> <span class="badge bg-green" ><?= h($donne_prete[$i]['etat']) ?></span></td>
 <td> <?= $this->Html->link(__('Commenter'), ['action' => 'cmntCertificatsEtudiants', $donne_prete[$i]['id_certif']], ['class'=>'btn btn-info btn-xs']) ?></td>
                <td class="actions" style="white-space:nowrap">
                 <form action="<?= $this->Url->build(['controller'=>'Resposcolarites','action'=>'editCertificatsEtudiants', $donne_prete[$i]['id_certif']]); ?>" method="post">
               <input class="btn btn-success btn-xs" name="editer" value="Délivrer" type="submit"> 
               </form>
               
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