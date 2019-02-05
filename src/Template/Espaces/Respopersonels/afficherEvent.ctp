<div class="box-header">
          <p class="text">Liste des événements organisés par les profs permanents à l'ENSA KHOURIBGA : <p>
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="activiteCherch" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
  <h1>
        <div class="text" ><?= $this->Html->link(__('Ajouter Activité'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?>
         <?= $this->Html->link(__('Ajouter un membre Comité'), ['action' => 'affecterProfEvnt'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1><br>
<div class="conteneur" >
<?php
$i=1;
 $precedent[1]=0;?>
                        <?php foreach ($profpermanentsActivites as $professeursActivite)
                        {
                        if(!in_array($professeursActivite->activite->id,$precedent))
                        {
                          array_push($precedent,$professeursActivite->activite->id);?>
<div class="col-md-4" >
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php if($professeursActivite->activite->photo<>''){?>
              <center><?php echo $this->Html->image($professeursActivite->activite->photo, array('height'=>'200','width'=>'200','class' => 'img-thumbnail', 'alt' => 'User Image'));?></center><?php
              }else{
                           ?> <center>Pas de Photo Descriptive de l'événement</center><?php

              }?>

              <center><?php echo $professeursActivite->activite->nomActivite ?></center>
              <center><?php echo $professeursActivite->activite->dateDebut ?></center>


            </div>
            <div >
              <i ></i>
            </div>
        <p class="text"><?php echo $this->Html->link(__('Comité organisateur'), ['action' => 'listerOrganisateur', $professeursActivite->activite->id], ['class'=>'btn btn-warning btn-xs']  );?></p>
          </div>
          </div><?php
if($i%3==0)
{
echo '<br>';
}
$i++;
}}?>
</div>

