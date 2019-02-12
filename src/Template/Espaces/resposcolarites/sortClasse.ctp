<!-- Content Header (Page header) -->
<section class="content-header">

  <?php
    foreach ($etudiants->toArray() as $etudiant) {
       //echo "<pre>" ;print_r($etudiant); die();
       $grpID = '';
                foreach ($etudiant->etudiers as $etudier):
                      $grpID = $etudier->groupe->id;
                  endforeach;

    }
               
                
                   ?>
  <h1>
    Liste des Etudiants
    <div class="pull-right">
      <?= $this->Html->link(__('Nouveau Etudiant'), ['action' => 'addUser'], ['class'=>'btn btn-success btn-xs']) ?>
      <?= $this->Html->link(__('Imprimer la Liste'), ['action' => 'printClasse',$grpID], ['class'=>'btn btn-info btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          
          <div >
            <form method="post" action="exportEtudiants">
              <input type="text" name="cat" class="form-control" placeholder="<?= __('Rechercher') ?>">
                   <div class="box-header">  
                    <h5> Filtrer Par :</h5>
                  <?php 
                  $options = [

                    'Rechercher un nom' => 'Nom',
                    'Rechercher un CNE' => 'CNE',
                    'Rechercher un CIN' => 'CIN',
                    'Rechercher un prenom' => 'Prenom'];

                  echo $this->Form->select('filtre', $options, ['default' => true]); 
                  ?></div>
                    <button class="btn btn-info btn-flat" type="submit"><?= __('Rechercher') ?></button>
            </form>
          </div>
          <div>
            <?php 
              echo $this->Form->create($etudiants,['class'=>'col-lg-6','data-toggle'=>'validator', 'role'=>'form','url'=>'/resposcolarites/sort-classe']) ;
           
                $options = [];
              foreach ($groupe as $cncr) {
                                   
                       $options[] = [$cncr->id => $cncr->niveau->libile." ".$cncr->filiere->libile];          }
         
          echo $this->Form->label('groupes', null, ['style' => ' display: inline; width: 20%; float: left; padding-top:3px; ']);                                         
          echo $this->Form->select('groupes', $options, ['escape' => false, 'id'=>'grps','empty' => 'Choisir groupes']);
           echo $this->Form->end();
          ?>
          </div>
        </div>

        <br>
        <!-- /.box-header -->
        <div class="box-body table-responsive  no-padding">
          <table class="table table-bordered">
            <tr >
              <th class="active">  </th>
              <th class="active"><?= $this->Paginator->sort('nom_fr', array('label'=>'Nom')) ?></th>
              <th class="active"><?= $this->Paginator->sort('prenom_fr', array('label'=>'Prenom')) ?></th>
              <th class="active"><?= $this->Paginator->sort('apogee', array('label'=>'Code Apogée')) ?></th>
              <th class="active"><?= $this->Paginator->sort('cne', array('label'=>'CNE')) ?></th>
              <th class="active"><?= $this->Paginator->sort('cin', array('label'=>'CIN')) ?></th>
              <th class="active"><?php echo 'Classe'; ?></th>
              <th class="active"><?= $this->Paginator->sort('validi', array('label'=>'Etat de l\'edition')) ?></th>

              <td align="center" class="active"><B>Actions</B></td>
              <td align="center" class="active"><B>Accorder droit de modification</B></td>
              <th class="active"><?= $this->Paginator->sort('valid_respo', array('label'=>'Action sur l\'edition')) ?></th>
            </tr>
                                    
            <?php foreach ($etudiants->toArray() as $etudiant): ?>
            <?php 
                $fil="";

                //foreach ($etudiant->Etudiers as $etudiers) {
                  //  
                //} 
                foreach ($etudiant->etudiers as $etudier):
                      $fil=$etudier->groupe->niveau->libile . " " .$etudier->groupe->filiere->libile;
                  endforeach;

            ?>

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
                <td><?= h($fil) ?></td>
                <?php if ($etudiant->validi==1): ?>
                <td class="success"> <?php echo "Validé"; ?> </td>
                 <?php  else:
                     ?>
                <td class="danger"> <?php echo "Edition"; ?> </td>

                  <?php endif;?>


                </td>
                
                <!-- <td align="center" class="active"><?= h($fil ) ?></td> -->
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
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
