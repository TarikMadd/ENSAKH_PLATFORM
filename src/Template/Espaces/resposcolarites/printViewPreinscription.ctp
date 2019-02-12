<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 75px;
    margin-left: 75px;">

<div style=" text-align: left;"  >
<?php echo $this->Html->image('av.jpg', ['alt' => 'CakePHP']); ?>
</div> </br>
<p style=" text-align: right;">    KHOURIBGA le <?php  echo date('d\/m\/y'); ?></p>
<br />
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>
<br />
<br />
     <h5>
           <?php echo __('Concours: '); ?>
    <?= $preinscription->has('concour') ? $preinscription->concour->niveau->libile." ".$preinscription->concour->filiere->libile : '' ?>
</h5>   

<p >  
<?php

$day  = date('d');
$day=$day+5;
$year = date('y');
$month  = date('m ');;
if($day>29)
{
  $day=$day-29;
$month=$month+1;
  if($month>12)
  {
    $year=$year+1;
  }

}
?>
  

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            
            <!-- /.box-header -->
            <div class="box-body">
            <div style="padding-bottom: 30px; font-size: 16px;">
                <fieldset > 
                    <legend>Informations Personnelles</legend>
                    <div class="form-inline">
                        <?php $image = ltrim(str_replace("\\", "/", $preinscription->image),'/img'); ?>
                        <?= $this->Html->image($image, ['alt' => 'Image','width'=>'150px','height'=>'150px']); ?>
                    </div>
                    <div class="form-inline">
                            <label class="control-label"><?= __('CNE : ') ?></label>
                            <div class="form-group"><?= $preinscription->cne ?></div>
                    </div> 
                    <div class="form-inline">
                                <label class="control-label"><?= __('CIN : ') ?></label>
                                <div class="form-group"><?= h($preinscription->cin) ?></div>
                    </div>       
                     <div class="form-inline">   
                             <label class="control-label"><?= __('Nom: ') ?></label>
                              <div class="form-group"><?= h($preinscription->nom_fr) ?></div>
                    </div>     
                     <div class="form-inline" style="text-align: right;display: block;">
                            <div class="form-group"><?= h($preinscription->nom_ar) ?></div>
                            <label class="control-label"><?= __(': الاسم العائلي') ?></label>
                                
                     </div>
                     <div class="form-inline">    
                             <label class="control-label"><?= __('Prénom: ') ?></label>
                              <div class="form-group"><?= h($preinscription->prenom_fr) ?></div>
                        
                     </div> 
                    <div class="form-inline" style="text-align: right;display: block;">  
                            <div class="form-group"><?= h($preinscription->prenom_ar) ?> </div> 
                             <label class="control-label"><?= __(':الاسم الشخصي') ?></label>  
                    </div>
                    <div class="form-inline">    
                             <label class="control-label"><?= __('Email: ') ?></label>
                              <div class="form-group"><?= h($preinscription->email) ?></div>
                        
                     </div>
                     <div class="form-inline">    
                             <label class="control-label"><?= __('Num de téléphone: ') ?></label>
                              <div class="form-group"><?= h($preinscription->tel) ?></div>
                        
                     </div>
                    <div class="form-inline">

                                <label class="control-label"><?= __('Handicap: ') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->type_handicap) ?>
                                </div>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Type d\'hébergement: ') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->type_hebergement) ?>
                                </div>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Situation Familiale: ') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->situation_familiale) ?>
                                </div>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Situation Militaire: ') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->situation_militaire) ?>
                                </div>
                    </div>
                    <div class="form-inline">              
                                <label class="control-label"><?= __('Date de Naissance: ') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->date_naissance) ?>
                                </div>
                    </div>


                    <div class="form-inline">
                                <label class="control-label"><?= __('Ville de Naissance :') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->ville_naissance_fr) ?>
                                </div>
                    </div>
                    <div class="form-inline" style="text-align: right;display: block;">
                                <div class="form-group">
                                    <?= h($preinscription->ville_naissance_ar) ?>
                                </div>
                                <label class="control-label"><?= __(': مكان الأزدياد') ?></label>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Pays de Naissance :') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->pays_naissance_fr) ?>
                                </div>
                    </div>
                    <div class="form-inline" style="text-align: right;display: block;">
                                <div class="form-group">
                                    <?= h($preinscription->pays_naissance_ar) ?>
                                </div>
                                <label class="control-label"><?= __(' : البلد') ?></label>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Sexe :') ?></label>
                                <div class="form-group">
                                    <?= h($preinscription->sexe_fr) ?>
                                </div>
                    </div>
                    <div class="form-inline" style="text-align: right;display: block;">
                                <div class="form-group">
                                    <?= h($preinscription->sexe_ar) ?>
                                </div>
                                <label class="control-label"><?= __(' : الجنس') ?></label>
                    </div>
                    <div class="form-inline" >
                                <label class="control-label"><?= __('Série Bac :') ?></label>
                                <div class="form-group">
                                <?= h($preinscription->serie_bac); ?>
                                </div>
                                 
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Etablissement Bac :') ?></label>
                                <div class="form-group">
                                <?= h($preinscription->etablissement_bac); ?>
                                </div>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Année d\'obtention') ?></label>
                                <div class="form-group">
                                <?= h($preinscription->annee_obtention_bac); ?>
                                </div>
                                
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Adresse Fix :') ?></label>
                                <div class="form-group">
                                <?= $this->Text->autoParagraph(h($preinscription->adresse_fix_fr)); ?>
                                </div>
                    </div>
                    <div class="form-inline" style="text-align: right;display: block;">
                                <div class="form-group">
                                <?= $this->Text->autoParagraph(h($preinscription->adresse_fix_ar)); ?>
                                </div>
                                 <label class="control-label"><?= __(' : العنوان') ?></label>
                    </div>
                    <div class="form-inline">
                                <label class="control-label"><?= __('Adresse Annulle :') ?></label>
                                <div class="form-group">
                                <?= $this->Text->autoParagraph(h($preinscription->adresse_annulle_fr)); ?>
                                </div>
                    </div>
                    <div class="form-inline" style="text-align: right;display: block;">
                                <div class="form-group">
                                <?= $this->Text->autoParagraph(h($preinscription->adresse_annulle_ar)); ?>
                                </div>
                                <label class="control-label"><?= __(': العنوان السنوي') ?></label>
                    </div>


                    

                </fieldset>
            </div>
            
            
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
                    <h3 class="box-title"><?= __('Cursus {0}', ['Universitaire']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($preinscription->preinscriptions_infos)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    
                                     <th>
                                    Type Diplome
                                    </th>   
                                                                    
                                    <th>
                                    Diplome
                                    </th>
                                        
                                                                    
                                    <th>
                                    Etablissement
                                    </th>
                                        
                                                                    
                                   
                                        
                                                                    
                                    <th>
                                    Semestre
                                    </th>
                                        
                                                                    
                                    <th>
                                    Note
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mention
                                    </th>
                                        
                                                                    
                                    <th>
                                    Année d'obtention
                                    </th>
                                        
                                                                    
                              
                            </tr>

                            <?php foreach ($preinscription->preinscriptions_infos as $preinscriptionsInfos): ?>
                                <tr>
                                                                        
                                    <?php 

                                    $serieDiplome = "";
                                    //echo "<pre>";print_r($preinscriptionsInfos->preinscriptions_diplome); die();
                                    /*foreach ($preinscriptionsInfos->preinscriptionsDiplome as $diplome): 
                                       $serieDiplome =  $diplome -> serie_fr;
                                     endforeach */?>
                                    <td>
                                    <?= h($preinscriptionsInfos->preinscriptions_diplome->type." ".$preinscriptionsInfos->preinscriptions_diplome->groupe) ?>
                                    </td>   

                                    <td>
                                    <?= h($preinscriptionsInfos->preinscriptions_diplome->serie_fr) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($preinscriptionsInfos->preinscriptions_etablissement->libelle) ?>
                                    </td>
                                                                        
                                   
                                                                        
                                    <td>
                                    <?= h($preinscriptionsInfos->semestre->libile) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($preinscriptionsInfos->note) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($preinscriptionsInfos->mention) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($preinscriptionsInfos->anneeObtention) ?>
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
                    <h3 class="box-title"><?= __('Les acrivités {0}', ['Parascolaires']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($preinscription->activitesdespreinscriptions)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    libeller
                                    </th>
                                        
                                                                    
                                
                            </tr>

                            <?php foreach ($preinscription->activitesdespreinscriptions as $activitesdespreinscriptions): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($activitesdespreinscriptions->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($activitesdespreinscriptions->libile) ?>
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

 <div >
    <div style="float:left;  margin-right: 20px;">École National des Sciences AppliquEes  Khouribga<br />
        ENSA, Bd. Beni Amir, B.P. 77, Khouribga</div>
    <div>Tél.  <span dir="ltr"> </span>+212 6 61 15 07 21 <br /> +212 6 64 16 66 30<br />
  Site web: <a rel="nofollow" rel="noreferrer"rel="nofollow" href="http://www.ensa.uh1.ac.ma/" target="_blank">www.ensa.uh1.ac.ma</a></div>
 </div>
</body>

</html>