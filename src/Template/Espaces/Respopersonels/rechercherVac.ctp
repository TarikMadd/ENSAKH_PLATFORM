
<section class="content-header">

</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <div class="panel panel-primary">
          <div class="panel-heading">Rechercher les professeurs vacataires à l'ENSA KHOURIBGA :
          <div class="box-tools">
          <br>
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;">
                <input type="text" name="chercherProf" class="form-control" style="width: 280px;" >
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat"style="margin-left:906px type="submit"><?= __('Filtrer') ?></button>
                </span>
              </div>
            </form>
            <br>
             Recherche par : Nom, Prenom, N de somme, Email, Lieu de naissance, Grade, Echelon ou indice de grade
          </div>
        </div>
        <br>
       
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
                      if(!isset($suivant[$j+1])||$suivant[$j+1]<>$professeursGrade->vacataire_id)
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
                      <h6 class="widget-user-username" ><?php echo $professeursGrade->vacataire->nom_vacataire.'  '.$professeursGrade->vacataire->prenom_vacataire;?></h6>
                      <h5 class="widget-user-desc"><?=($professeursGrade->cadre == 'H') ? 'Habilité' : (($professeursGrade->cadre == 'A') ? 'Assistant' : 'PES') ?></h5>
                      <h5 class="widget-user-desc">Grade : <?=  ($professeursGrade->sous_grade) ?></h5>
                      <h5 class="widget-user-desc">Echelon : <?=  ($professeursGrade->echelon) ?></h5>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="<?php echo $this->Url->build(['action' => 'viewvacataire', $professeursGrade->vacataire_id]); ?>" >Somme<span class="pull-right badge bg-blue"><?=$professeursGrade->vacataire->somme?>
                        <li><a href="#">Specialité <span class="pull-right badge bg-aqua"><?=$professeursGrade->vacataire->specialite?></span></a></li>
                        <li><a href="#">Lieu Naissance <span class="pull-right badge bg-green"><?=$professeursGrade->vacataire->LieuNaissance?></span></a></li>
                        <li><a href="#">Date de naissance <span class="pull-right badge bg-red"><?=$professeursGrade->vacataire->dateNaissance?></span></a></li>
                      </ul>
                    </div>
                    <a href="<?php echo $this->Url->build(['action' => 'viewvacataire', $professeursGrade->vacataire_id]); ?>" class="small-box-footer">
                    Plus d'informations <i class="fa fa-arrow-circle-right"></i>
                </a>
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
