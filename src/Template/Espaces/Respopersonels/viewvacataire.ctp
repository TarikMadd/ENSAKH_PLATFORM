<section class="content-header">
  <h1>
    <?php echo __('Vacataire'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
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
                                                                                                                <dt><?= __('Somme') ?></dt>
                                        <dd>
                                            <?= h($vacataire->somme) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Nom Vacataire') ?></dt>
                                        <dd>
                                            <?= h($vacataire->nom_vacataire) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Prenom Vacataire') ?></dt>
                                        <dd>
                                            <?= h($vacataire->prenom_vacataire) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('LieuNaissance') ?></dt>
                                        <dd>
                                            <?= h($vacataire->LieuNaissance) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Diplome') ?></dt>
                                        <dd>
                                            <?= h($vacataire->diplome) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Universite') ?></dt>
                                        <dd>
                                            <?= h($vacataire->universite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Specialite') ?></dt>
                                        <dd>
                                            <?= h($vacataire->specialite) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('CIN') ?></dt>
                                        <dd>
                                            <?= h($vacataire->CIN) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('SituationFamiliale') ?></dt>
                                        <dd>
                                            <?= h($vacataire->situationFamiliale) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('CodeSituation') ?></dt>
                                        <dd>
                                            <?= h($vacataire->codeSituation) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('User Id') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->user_id) ?>
                                </dd>
                                                                                                                <dt><?= __('Nb Heures') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->nb_heures) ?>
                                </dd>
                                                                                                                <dt><?= __('Echelle') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->echelle) ?>
                                </dd>
                                                                                                                <dt><?= __('Echelon') ?></dt>
                                <dd>
                                    <?= $this->Number->format($vacataire->echelon) ?>
                                </dd>
                                                                                                
                                                                                                        <dt><?= __('DateRecrut') ?></dt>
                                <dd>
                                    <?= h($vacataire->dateRecrut) ?>
                                </dd>
                                                                                                                    <dt><?= __('DateNaissance') ?></dt>
                                <dd>
                                    <?= h($vacataire->dateNaissance) ?>
                                </dd>
                                                                                                                    <dt><?= __('DateAffectation') ?></dt>
                                <dd>
                                    <?= h($vacataire->dateAffectation) ?>
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

   
   
   
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Departements']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->departements)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Nom Departement
                                    </th>
                                        
                                                                    
                                  
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php 

                            
                            foreach ($vacataire->departements as $departements):  ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($departements->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($departements->nom_departement) ?>
                                    </td>
                                                                        
                                    <td>
                                    
                                    
                                                                      

                                  

                                    <?= $this->Form->postLink(__('Desaffecter'), ['controller' => 'respopersonels', 'action' => 'desaffectervacataire', $departements['_joinData']['id']], ['confirm' => __('cùest sur vous voulez desaffecter ce vacataire de cet departement? # {0}?', $departements->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
  

      <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Grades']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($vacataire->grades)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    CodeGrade
                                    </th>
                                        
                                                                    
                                    <th>
                                    Taux
                                    </th>
                                        
                                                                    
                                    <th>
                                    NomGrade
                                    </th>
                                        
                                                                    
                                    <th>
                                    Categorie
                                    </th>
                                         <th>
                                    Date debut
                                    </th>
                                        
                                         <th>
                                    Date Fin
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php 

                            foreach ($vacataire->grades as $grades):  ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($grades->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->codeGrade) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->taux) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->nomGrade) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($grades->categorie) ?>
                                    </td>
                                    <td>
                                    <?= h($grades['_joinData']['datedebut']) ?>
                                    </td>
                                   <td>
                                    <?= h($grades['_joinData']['datefin']) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'respopersonels', 'action' => 'modifiervacgrade', $grades['_joinData']['id']], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'respopersonels', 'action' => 'desaffectergrade', $grades['_joinData']['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $grades['_joinData']['id']), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
