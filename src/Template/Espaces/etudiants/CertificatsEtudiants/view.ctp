<section class="content-header">
  <h1>
    <?php echo __('Certificats'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Retour'), ['action' => 'indexCertificats'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Informations'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Certificat') ?></dt>
                                <dd>
                                    <?=  $certificatsEtudiant->certificat->type ; ?>
                                </dd>
                                                                                                                <dt><?= __('Modifié le') ?></dt>
                                <dd>
                                    <?= h($certificatsEtudiant->modified ) ?>
                                </dd>
                                                                                                                <dt><?= __('Commmentaire') ?></dt>
                                 <dd>
                                    <?= h($certificatsEtudiant->commentaire ) ?>
                                </dd>   
                                                                                                                        <dt><?= __('Etat') ?></dt>
                                        <dd ><?php switch ($certificatsEtudiant->etat){
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
                 ?>
                                        </span>
                                        </dd>                                                                                            
                                            
                                            
                                                                                                                                                                                                
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>
