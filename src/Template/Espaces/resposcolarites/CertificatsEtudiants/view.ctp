<section class="content-header">
  <h1>
    <?php echo __('Certificats Etudiant'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'indexCertificatsEtudiants'], ['escape' => false])?>
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
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Certificat Id') ?></dt>
                                                                                                         <dd>
                                    <?= $certificatsEtudiant->has('certificat') ? $certificatsEtudiant->certificat->id : '' ?>
                                </dd>
                                  <dt><?= __('Type du certificat') ?></dt>
                                                                                                         <dd>
                                    <?= $certificatsEtudiant->has('certificat') ? $certificatsEtudiant->certificat->type : '' ?>
                                </dd> 
 

                               
                                                                                                                <dt><?= __('Etudiant') ?></dt>
                                <dd>
                                    <?= $certificatsEtudiant->has('etudiant') ? $certificatsEtudiant->etudiant->nom_fr : '' ?>
                                </dd> 

                                                                                                                <dt><?= __('Prenom') ?></dt>
                                <dd>
                                    <?= $certificatsEtudiant->has('etudiant') ? $certificatsEtudiant->etudiant->prenom_fr : '' ?>
                                </dd> 

                                                                                                                <dt><?= __('CNE') ?></dt>
                                <dd>
                                    <?= $certificatsEtudiant->has('etudiant') ? $certificatsEtudiant->etudiant->cne : '' ?>
                                </dd> 

                                                                                                               
                                                                                                                        <dt><?= __('Etat') ?></dt>
                                 <dd>
                                            <?= h($certificatsEtudiant->etat) ?>
                                        </dd>                                                                                            
                                        
          <!-- ******************************************************************************************************************************** -->                              
                                
                                       
                                            
                                                                                                                                                                                                
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->


<table>


<td class="actions" style="white-space:nowrap">
              
                <?= $this->Html->link(__('imprimer'), ['action' => 'comCertificatsEtudiants', $certificatsEtudiant->id], ['class'=>'btn btn-warning btn-xs' ]) ?> 
                
                </td>
				<td width=10% ></td>
				
				<td    class="actions" style="white-space:nowrap">
				 <form action="<?= $this->Url->build(['controller'=>'Resposcolarites','action'=>'editCertificatsEtudiants', $certificatsEtudiant->id ]); ?>" method="POST">
                  
                  <input class="btn b* btn-warning btn-xs" name="editer" value="Approuver" type="submit">
                    </form>
					</td>
					</tr>
					</table>
</section>

