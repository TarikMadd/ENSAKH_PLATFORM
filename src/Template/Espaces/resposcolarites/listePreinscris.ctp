<!-- Content Header (Page header) -->
<?php use Cake\Routing\Router; ?>
<section class="content-header">
  <h1>
    Pré Inscriptions
    <div class="pull-right">
    <?= $this->Html->link(__('Imprimer la Liste'), ['action' => 'printListePreinscription'], ['class'=>'btn btn-info btn-xs']) ?>
  </div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= __('Liste des') ?> Pré Inscriptions</h3>
           <div >
             <?php 
              echo $this->Form->create($preinscriptions,['class'=>'col-lg-6','name' => 'frmCncr','url'=>'/resposcolarites/liste-preinscris-concours']) ;
                $options = [];
                foreach ($concour as $cncr) {              
                       $options[] = [$cncr->id => $cncr->niveau->libile." ".$cncr->filiere->libile];                                          
                                                    }
              echo $this->Form->label('Concours', null, ['style' => ' display: inline; width: 20%; float: left; padding-top:3px; ']);                                         
              echo $this->Form->select('Concours', $options, ['escape' => false, 'id'=>'cncrs','empty' => 'Choisir Concours']);
               echo $this->Form->end();
              ?>
          </div>
            
          <div class="box-tools">
             <form action="/resposcolarites/find_preinscriptions" method="POST" id="frmRecherche">
              <div class="input-group input-group-sm"  style="width: 180px;">
                 <?php echo $this->Form->input('motif', ['type' => 'text','class'=>'form-control','id'=>'recherche','templates' => ['inputContainer' => '{{content}}'],'label' => false,'placeholder'=>__('recherche par:'),'style' => ' width: 200px;']); ?>
                 <span class="input-group-btn">
                   
                    <?php 
                    $filtres = ['cne' => 'cne','nom' => 'nom','prenom' => 'prenom']; 
                    echo $this->Form->select('filtre', $filtres, ['escape' => false, 'id'=>'fltrs','style' => ' width: 80px; margin-left:3px;']); 
                    ?>
                </span>
                <script>
                 var srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreInscriptionsByCne')); ?>";

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
                       srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreInscriptionsByCne')); ?>";
                        break;
                    case 'nom':   
                        srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreInscriptionsByNom')); ?>";
                        break;
                    case 'prenom':   
                        srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreInscriptionsByPrenom')); ?>";
                        break;
                    default:
                        srce = "<?php echo Router::url(array('controller' => 'Resposcolarites', 'action' => 'getAllPreInscriptionsByCne')); ?>";
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
        <form action="/resposcolarites/preselectione-groupe" method="POST" id="chkPreSelection">
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
              <th>
                <?= 
                $this->Form->input('Tous', array('type' => 'checkbox','id'=>'cocherTous'));
                ?>
             </th>
              <th>
                <?=
                $this->Form->button('Présélectionné les candidats ?', ['type' => 'button','id'=>'preselecteGroupe']);
               ?>
             </th>
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
                 <td><?php 
                  if ($preinscription->preselection == 0) {
                    echo $this->Form->checkbox('ListPreselecione.', array( 'value'=>$preinscription->id,'id' => $preinscription->id, 'error' => false, 'placeholder' => false,'div'=>false,'label'=>false,'class' => '', 'data-off-text'=>'No', 'data-on-text' =>'Yes', 'hiddenField'=>true) ); 
                 }else{
                    echo $this->Form->checkbox('ListPreselecione.', array( 'value'=>$preinscription->id,'id' => $preinscription->id, 'error' => false, 'placeholder' => false,'div'=>false,'label'=>false,'class' => '', 'data-off-text'=>'No', 'data-on-text' =>'Yes', 'hiddenField'=>true,'style'=> 'pointer-events: none; cursor: default;','disabled'=> true) );
                 }
                 ?></td>
                <td class="actions" style="white-space:nowrap">
                  
                  <?= $this->Html->link(__('Informations'), ['action' => 'viewPreinscription', $preinscription->id], ['class'=>'btn btn-info btn-xs']) ?>
                  <?php 
                  if ($preinscription->preselection == 0) {
                     echo $this->Html->link(__('Présélectionné ?'), ['action' => 'preselectione', $preinscription->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-success btn-xs']);
                  }else{
                     echo $this->Form->postLink(__('Candidat présélectionné'), ['action' => 'preselectione', $preinscription->id], ['confirm' => __('Confirmer?'), 'class'=>'btn btn-success btn-xs', 'style'=> 'pointer-events: none;
                        cursor: default; background-color: #555;' ]);
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