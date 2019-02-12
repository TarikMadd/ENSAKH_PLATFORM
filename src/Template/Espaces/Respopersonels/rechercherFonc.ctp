
<section class="content-header">

</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <div class="panel panel-primary">
          <div class="panel-heading">Rechercher les fonctionnaires à l'ENSA KHOURIBGA :
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
             Recherche par : Nom, Prenom, N de somme, Email, Lieu de naissance
          </div>
        </div>
        <br>
       
        <!-- /.box-header -->

        <?php
        $i=1;
        foreach ($profpermanentsGrades as $professeursGrade)
        {
        $suivant[$i]=$professeursGrade->id;
        $i++;
        }

                    $j=1;
                    foreach ($profpermanentsGrades as $professeursGrade)
                    {
                      if(!isset($suivant[$j+1])||$suivant[$j+1]<>$professeursGrade->id)
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
                      <h6 class="widget-user-username" ><?php echo $professeursGrade->nom_fct.'  '.$professeursGrade->prenom_fct;?></h6>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="<?php echo $this->Url->build(['action' => 'viewfonctionnaire', $professeursGrade->id]); ?>" >Somme<span class="pull-right badge bg-blue"><?=$professeursGrade->somme?>
                        <li><a href="#">Specialité <span class="pull-right badge bg-aqua"><?=$professeursGrade->specialite?></span></a></li>
                        <li><a href="#">Lieu Naissance <span class="pull-right badge bg-green"><?=$professeursGrade->lieuNaissance?></span></a></li>
                        <li><a href="#">Date de naissance <span class="pull-right badge bg-red"><?=$professeursGrade->dateNaissance?></span></a></li>
                      </ul>
                    </div>
                    <a href="<?php echo $this->Url->build(['action' => 'viewfonctionnaire', $professeursGrade->id]); ?>" class="small-box-footer">
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
