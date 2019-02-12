<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Liste des Etudiants</h1>
    <div class="pull-left">
    <?= $this->Html->link('<i class="fa fa-undo"></i> '.__('Revenir à la liste des etudiants'), ['action' => 'etudiantListe'], ['escape' => false]) ?>
  </div>
    <div class="pull-right">
    <?= $this->Html->link(__('Nouveau Etudiant'), ['action' => 'addUser'], ['class'=>'btn btn-success btn-xs']) ?>

  <?= $this->Html->link(__('Imprimer la Liste'), ['action' => 'printListeEtudiant'], ['class'=>'btn btn-info btn-xs']) ?>
  </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          
          <div class="toolbox">
             <form method="post" action="exportEtudiants">
              <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher') ?>">
                   <div class="box-header">  
                  <?php 
                  $options = [

                    'Rechercher un nom' => 'Nom',
                    'Rechercher un CNE' => 'CNE',
                    'Rechercher un CIN' => 'CIN',
                    'Rechercher un prenom' => 'Prenom'];

                  echo $this->Form->select('filtre', $options, ['empty' => true]); ?></div>
                    <button class="btn btn-info btn-flat" type="submit"><?= __('Rechercher') ?></button>
            </form>
          </div>
        </div>


        <br>
        <!-- /.box-header -->
        <div class="box-body table-responsive  no-padding">
          <table class="table table-bordered">
            <tr >
              <th class="active">  </th>
              <th class="active"><B>Nom</th>
              <th class="active"><B>Prenom</B></th>
              <th class="active"><B>Code Apogée</B></th>
              <th class="active"><B>CNE</B></th>
              <th class="active"><B>CIN</B></th>
              <th class="active"><B>Etat de l\'edition</B></th>
              <th class="active">Classe</th>
              <td align="center" class="active"><B>Actions</B></td>
              <td align="center" class="active"><B>Accorder droit de modification</B></td>
              <th class="active"><B>Action sur l\'edition</B></th>
            </tr>
            <?php foreach ($etudiants as $etudiant): ?>
            <?php 
                $fil="";
                foreach ($etudiant->etudiers as $etudiers) {
                    $fil=$etudiers->groupe->niveau->libile . " " .$etudiers->groupe->filiere->libile;
                } ?>
              <tr>
                <?php 
               if($etudiant->photo){
                    $image = ltrim(str_replace("\\", "/", $etudiant->photo),'/img');
               }else{
                    $image = "Etudiants\profile.jpg";
               }
                

               ?>
                <td ><?php echo $this->Html->image($image, array('width' => 45, 'height' => 50)); ?></td>
                <td ><?= h($etudiant->nom_fr) ?></td>
                <td><?= h($etudiant->prenom_fr) ?></td>
                <td><?= h($etudiant->apogee) ?></td>
                <td><?= h($etudiant->cne) ?></td>
                <td><?= h($etudiant->cin) ?></td>
                <?php if ($etudiant->validi==1): ?>
                <td class="success"> <?php echo "Validé"; ?> </td>
                 <?php  else:
                     ?>
                <td class="danger"> <?php echo "Edition"; ?> </td>

                  <?php endif;?>


                </td>
                 <td align="center" class="active"><?= h($fil ) ?></td>
                <td class="actions" style="white-space:nowrap" align="center">
                  <?= $this->Html->link(__('View'), ['action' => 'viewEtudiant', $etudiant->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?= $this->Html->link(__('Print'), ['action' => 'printEtudiant', $etudiant->id], ['class'=>'btn btn-success btn-xs']) ?>
                  <?= $this->Html->link(__('Edit'), ['action' => 'editEtudiant', $etudiant->id], ['class'=>'btn btn-warning btn-xs']) ?>
                  <?= $this->Form->postLink(__('Supprimer'), ['action' => 'deleteEtudiant', $etudiant->id], ['confirm' => __('Voulez vous vraiment supprimer ce champ?'), 'class'=>'btn btn-danger btn-xs']) ?>
                  
                </td>
                <td align="center">
                  <?= $this->Form->postLink(__('+'), ['action' => 'droitModif', $etudiant->id], ['confirm' => __('Voulez vous vraiment donner le droit de Modification a cet etudiant?'), 'class'=>'btn btn-success btn-xs']) ?>
                  </td>
                  <?php  if ($etudiant->valid_respo==0): ?>
                  <td class="warning">
                  
                    <?= $this->Form->postLink(__('Valider infos'), ['action' => 'validerInfos', $etudiant->id], ['confirm' => __('Voulez vous vraiment valider les Informations?')]) ?> 
                  </td> <?php  ?>
                  
                  <?php 
                  else: ?> <td class="success"> <?php echo 'Validé' ; endif;?> </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        
    </div>
  </div>
</section>
<!-- /.content -->
