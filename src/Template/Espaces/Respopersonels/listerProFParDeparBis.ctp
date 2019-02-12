

<!-- Main content -->
<section class="content">
<ol class="breadcrumb">
              <li>
              <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'listerProfsParDepar'], ['escape' => false])?>
              </li></ol>

  <div class="row">
    <div class="col-xs-12">
<div class="box">
        <div class="box-header">
                 <div class="panel panel-primary">

          <div class="panel-heading">Liste des professeurs permanents qui appartiennent à :  <?= $nomDep ?> </div>


          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm"  style="width: 180px;margin-left:906px">
                <input type="text" name="chercherProf" class="form-control"  placeholder="<?= __('Rechercher un Professeur') ?>">
                <span class="input-group-btn">
                <button class="btn btn-info btn-flat" type="submit"><?= __('Filtrer') ?></button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->

        <?php

        foreach ($ProfpermanentsDepartements as $profdepartement)
        {?>
         <div class="col-md-4">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                      <h3 class="widget-user-username"><?php echo $profdepartement->profpermanent->nom_prof.'  '.$profdepartement->profpermanent->prenom_prof;?></h3>
                      <h5 class="widget-user-desc"><?= $profdepartement->Poste_Filiere ?></h5>
                    </div>
                    <div class="widget-user-image">
                      <?php echo $this->Html->image('user1-128x128.jpg', ['alt' => 'User Avatar', 'class' => 'img-circle']); ?>
                    </div>
                    <div class="box-footer">
                      <div class="row">
                        <div class="col-sm-4 border-right">
                          <div class="description-block">

                          <span class="description-text"><?= $this->Form->postLink(__('Delete'), ['action' => 'deleteProfDepar', $profdepartement->id], ['confirm' => __('Confirm to delete this entry?'), 'class'=>'btn btn-danger btn-xs'])?></span>
                         <h5 class="description-header"></h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                          <span class="description-text">Date Affectation </span>
                          <span class="description-text"><?=$profdepartement->Date_Debut?></span>

                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                          <div class="description-block">
                            <h5 class="description-header"><?= $this->Html->link(__('Modifier'), ['action' => 'edit', $profdepartement->id], ['class'=>'btn btn-success btn-xs'])?></h5>
                             <h5 class="description-header"></h5>


                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
<?php
        }
        ?>

      <!-- /.box -->
    </div>
  </div>
</section>

</section>
</body>

</html>
