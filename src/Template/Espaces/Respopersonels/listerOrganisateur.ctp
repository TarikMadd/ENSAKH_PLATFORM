<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  <?php
  foreach ($profpermanentsActivite as $professeurActivite)
    {
    $nomAct=$professeurActivite->activite->nomActivite;
    break;
    }?>
    <ol class="breadcrumb">
        <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'afficherEvent'], ['escape' => false])?>
        </li>
      </ol>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Contribution des professeurs permanents à : <?= $nomAct ?> <br> </h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">

              <?php
               foreach ($profpermanentsActivite as $professeurActivite)
              {
              ?><div class="col-md-3">
                                       <p class="imageProf" ><?php echo $this->Html->image('157.jpg', array('class' => 'img-circle', 'alt' => 'User Image'));?></p>

                                      <?php  echo '<br><p class="bg-warning"> Nom : '.$professeurActivite->profpermanent->nom_prof;
                                        echo '  </p>Prenom :  '.$professeurActivite->profpermanent->prenom_prof.'<br> <p class="bg-success">Poste :'.$professeurActivite->poste_comite;

                                        ?></div><?php


              }
              ?>
          </div>
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
