<!-- Content Header (Page header) -->
<?php use Cake\Routing\Router; ?>
<section class="content-header">
                <?php
                $cncrId = "";
                 foreach ($preinscriptions as $preinscription):
                      $cncrId = $preinscription->concour->id;
                  endforeach;

                  echo $this->Form->hidden('idCncr',['value' => $cncrId]); ?>
  <h1>
    Présélections
    <div class="pull-right">
    <?= $this->Html->link(__('Imprimer la Liste'), ['action' => 'printListePreselectionesConcours', $cncrId], ['class'=>'btn btn-info btn-xs']) ?>
  </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Présélectionnés</h3>
           <div>
             <?php 
              echo $this->Form->create($preinscriptions,['class'=>'col-lg-6','data-toggle'=>'validator', 'role'=>'form','url'=>'/resposcolarites/liste-preselectiones-concours']) ;
           
                $options = [];
              foreach ($concour as $cncr) {
                                   
                       $options[] = [$cncr->id => $cncr->niveau->libile." ".$cncr->filiere->libile];          }
         
          echo $this->Form->label('Concours', null, ['style' => ' display: inline; width: 20%; float: left; padding-top:3px; ']);                                         
          echo $this->Form->select('Concours', $options, ['escape' => false, 'id'=>'cncrs','empty' => 'Choisir Concours']);
           echo $this->Form->end();
          ?>
            </div>
          <div class="box-tools">
            <form action="/resposcolarites/find_preselections" method="POST" id="frmRecherche">
              <div class="input-group input-group-sm"  style="width: 180px;">
                 <?php echo $this->Form->input('motif', ['type' => 'text','class'=>'form-control','id'=>'recherche','templates' => ['inputContainer' => '{{content}}'],'label' => false,'placeholder'=>__('recherche par:'),'style' => ' width: 200px;']); ?>
                 <span class="input-group-btn">
                   
                    <?php 
                    $filtres = ['cne' => 'cne','nom' => 'nom','prenom' => 'prenom']; 
                    echo $this->Form->select('filtre', $filtres, ['escape' => false, 'id'=>'fltrs','style' => ' width: 80px; margin-left:3px;']); 
                    ?>
                </span>
                
                <script>
                 var srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreSelectionsConcoursByCne', $cncrId)); ?>";

                 jQuery('#recherche').autocomplete({
                      source:srce,
                      minLength: 1,
                      select: function(event, ui) { 
                          $("#recherche").val(ui.item.value);
                          $("#frmRecherche").submit(); }
                  });

                 $('#fltrs').on('change', function() {
                  //alert(this.value);
                  var mtf = this.value;
                  switch (mtf) {
                    case 'cne':  
                       srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreSelectionsConcoursByCne', $cncrId)); ?>";
                        break;
                    case 'nom':   
                        srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreSelectionsConcoursByNom', $cncrId)); ?>";
                        break;
                    case 'prenom':   
                        srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreSelectionsConcoursByPrenom', $cncrId)); ?>";
                        break;
                    default:
                        srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreSelectionsConcoursByCne', $cncrId)); ?>";
                        break;
                  } 

                    jQuery('#recherche').autocomplete({
                      source:srce,
                      minLength: 1,
                      select: function(event, ui) { 
                          $("#recherche").val(ui.item.value);
                          $("#frmRecherche").submit(); }
                  });

                      });
                 </script>   
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <form action="/resposcolarites/admis-groupe" method="POST" id="chkAdmis">
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th><?= __('Code d\'inscription') ?></th>
              <th><?= __('Cne') ?></th>
              <th><?= __('Cin') ?></th>
              <th><?= __('Nom') ?></th>
              <th><?= __('Prénom') ?></th>
              <th><?= __('Sexe') ?></th>
              <th><?= __('Date de naissance') ?></th>
             
              <th><?= __('concours') ?></th>
             <th><?= 
                $this->Form->input('Tous', array('type' => 'checkbox','id'=>'cocherTous'));
                ?></th>
              <th><?php
                echo $this->Form->button('Tous Admis ?', ['type' => 'button','id'=>'preselecteGroupe','style'=> 'margin-right: 1px; ']);
                echo $this->Form->button('Liste d\'attente ?', ['type' => 'button','id'=>'preselecteAttenteGroupe']);
                echo $this->Form->checkbox('ListAttente', array( 'value'=>1,'id' => 'attente', 'error' => false, 'placeholder' => false,'div'=>false,'label'=>false, 'data-off-text'=>'No', 'data-on-text' =>'Yes', 'hiddenField'=>true,'style'=>'display: none;') );
               ?></th>
            </tr>
            <?php foreach ($preinscriptions as $preinscription): ?>
              <tr>
                <td><?= h($preinscription->id) ?></td>
                <td><?= h($preinscription->cne) ?></td>
                <td><?= h($preinscription->cin) ?></td>
                <td><?= h($preinscription->nom_fr) ?></td>
                <td><?= h($preinscription->prenom_fr) ?></td>
                <td><?= h($preinscription->sexe_fr) ?></td>
                <td><?= $preinscription->date_naissance ?></td>
               
                <td><?= $preinscription->has('concour') ? $preinscription->concour->niveau->libile." ".$preinscription->concour->filiere->libile : '' ?></td>
                <td>
                  <?php 
                  if ($preinscription->admis == 0 && $preinscription->listeAttente == 0) {
                    echo $this->Form->checkbox('ListAdmis.', array( 'value'=>$preinscription->id,'id' => $preinscription->id, 'error' => false, 'placeholder' => false,'div'=>false,'label'=>false,'class' => '', 'data-off-text'=>'No', 'data-on-text' =>'Yes', 'hiddenField'=>true) ); 
                 }else{
                    echo $this->Form->checkbox('ListAdmis.', array( 'value'=>$preinscription->id,'id' => $preinscription->id, 'error' => false, 'placeholder' => false,'div'=>false,'label'=>false,'class' => '', 'data-off-text'=>'No', 'data-on-text' =>'Yes', 'hiddenField'=>true,'style'=> 'pointer-events: none; cursor: default;','disabled'=> true) );
                 }
                 ?>
                </td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('Informations'), ['action' => 'viewPreinscription', $preinscription->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?php 
                   if ($preinscription->admis == 0 && $preinscription->listeAttente == 0) {
                      echo $this->Html->link(__('Admis'), ['action' => 'admis', $preinscription->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-success btn-xs','style'=> 'margin-right: 3px; ']);
                      echo $this->Form->postLink(__('Liste d\'attente'), ['action' => 'listeAttente', $preinscription->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-success btn-xs']); 
                    }else{
                      if($preinscription->admis != 0){
                          echo $this->Form->postLink(__('Candidat Admis'), ['action' => 'admis', $preinscription->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-success btn-xs', 'style'=> 'pointer-events: none; cursor: default; background-color: #555;']);
                      }else{
                        echo $this->Form->postLink(__('Candidat en liste d\'attente'), ['action' => 'listeAttente', $preinscription->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-success btn-xs', 'style'=> 'pointer-events: none; cursor: default; background-color: #555;']);
                      }
                      
                         
                    }
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </form>
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
