
<section class="content-header">

</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <div class="panel panel-primary">
          <div class="panel-heading">Liste des professeurs permanents à l'ENSA KHOURIBGA :
          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="chercherProf" class="form-control"  ?>
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat"style="margin-left:906px type="submit"><?= __('Filtrer') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->

        <?php
        $i=1;
        foreach ($profpermanentsGrades as $professeursGrade)
        {
        $suivant[$i]=$professeursGrade->profpermanent_id;
        $i++;
        }

                    $j=1;
                    foreach ($profpermanentsGrades as $professeursGrade)
                    {
                      if(!isset($suivant[$j+1])||$suivant[$j+1]<>$professeursGrade->profpermanent_id)
                      {?>
        <div class="col-md-6">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2" >
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow">
                      <div class="widget-user-image">
                        <?php echo $this->Html->image('157.jpg', ['alt' => 'User Prof', 'class' => 'img-circle']); ?>
                      </div>
                      <!-- /.widget-user-image -->
                      <h6 class="widget-user-username" ><?php echo $professeursGrade->profpermanent->nom_prof.'  '.$professeursGrade->profpermanent->prenom_prof;?></h6>
                      <h5 class="widget-user-desc"><?=$professeursGrade->grade->nomGrade?></h5>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="/Respopersonels/viewProfBis/<?=$professeursGrade->profpermanent->id?>" >Somme<span class="pull-right badge bg-blue"><?=$professeursGrade->profpermanent->somme?>
                        <li><a href="#">Specialité <span class="pull-right badge bg-aqua"><?=$professeursGrade->profpermanent->specialite?></span></a></li>
                        <li><a href="#">Lieu Naissance <span class="pull-right badge bg-green"><?=$professeursGrade->profpermanent->Lieu_Naissance?></span></a></li>
                        <li><a href="#">Date de naissance <span class="pull-right badge bg-red"><?=$professeursGrade->profpermanent->dateNaissance?></span></a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>


        <?php
                                    $j++;
                                    }
                                    else{
                                    $j++;}
                      }
        ?>

      <!-- /.box -->
    </div>
  </div>
</section>

</section>
</body>

</html>
