<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Statistiques
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Statistiques</li>
  </ol>
</section>


<section class="content">
<section class="col-lg-8 connectedSortable">
  <div class="row">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">La période de pique</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
               <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Les ouvrages</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th><?= $this->Paginator->sort('ISBN') ?></th>
                <th><?= $this->Paginator->sort('titre') ?></th>
                <th><?= $this->Paginator->sort('auteur') ?></th>
                <th><?= $this->Paginator->sort('edition') ?></th>
                <th><?= $this->Paginator->sort('nombre Exemplaires') ?></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <?php for ($i=0;$i<count($book)/3;$i++) {?>
              <tr>
                <td><?= h($book[$i]['ISBN']) ?></td>
                <td><?= h($book[$i]['titre']) ?></td>
                <td><?= h($book[$i]['auteur']) ?></td>
                <td><?= h($book[$i]['edition']) ?></td>
                <td><?= h($book[$i]['nbExemplaire']) ?></td>
              </tr>
            <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <?= $this->Html->link(__('Ajouter Ouvrages'), ['action' => 'badrajouterOuvrages'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']) ?>
          <?= $this->Html->link(__('Consulter Ouvrages'), ['action' => 'badrconsulterOuvrages'], ['class'=>'btn btn-sm btn-default btn-flat pull-right']) ?>
        </div>
        <!-- /.box-footer -->
      </div>
        </div>

</section>
<section class="col-lg-4 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">

              <i class="fa  fa-thumbs-o-up"></i>
              <p class="text-center">
                <strong>Ouvrages les Plus demandés</strong>
              </p>
              <?php for ($i=0; $i < 5; $i++) { 
                if($i<count($demande)){?>
              <div class="progress-group">
                <span class="progress-text"><?= $demandetitre[$i] ?></span>
                <span class="progress-number"><b><?= $demande[$i]['num'] ?></b></span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-aqua" style="width: <?= ($demande[$i]['num']/$totaleEmprunte[0]['num'])*100 ?>%"></div>
                </div>
              </div>
             <?php }} ?>
            </div>
          </div>
                <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Ouvrages Empruntées</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <table class="table no-margin">
              <thead>
              <tr>
                <th><?= $this->Paginator->sort('numInventaire') ?></th>
                <th><?= $this->Paginator->sort('titre') ?></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <?php for ($i=0;$i<count($empreinter)/3;$i++) { ?>
              <tr>
                <td><?= $empreinter[$i]['numInventaire'] ?></td>
                <td><?= $empreinter[$i]['titre'] ?></td>
              </tr>
            <?php } ?>
              </tbody>
            </table>
        </div>
        <!-- /.footer -->
      </div>
            <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ouvrages Résérvées</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table no-margin">
              <thead>
              <tr>
                <th><?= $this->Paginator->sort('numInventaire') ?></th>
                <th><?= $this->Paginator->sort('titre') ?></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <?php for ($i=0;$i<count($reserver)/3;$i++) { ?>
              <tr>
                <td><?= $reserver[$i]['numInventaire'] ?></td>
                <td><?= $reserver[$i]['titre'] ?></td>
              </tr>
            <?php } ?>
              </tbody>
            </table>
        </div>
      </div>
            <?php if (count($deppassement)>0) {?>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span>Alerte</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th><?= $this->Paginator->sort('numéro inventaire') ?></th>
                <th><?= $this->Paginator->sort('utilisateurs') ?></th>
                <th><?= $this->Paginator->sort('role') ?></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <?php for ($i=0;$i<count($deppassement)/3;$i++) {?>
              <tr>
                <td><?= h($deppassement[$i]['numInventaire']) ?></td>
                <td><?= h($deppassement[$i]['username']) ?></td>
                <td><?= h($deppassement[$i]['role']) ?></td>
              </tr>
            <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-footer -->
      </div>
      <?php }?>
</section>
  <div class="row">

  </div>
<?php
$this->Html->script([
  'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
  'AdminLTE./plugins/flot/jquery.flot.min',
  'AdminLTE./plugins/flot/jquery.flot.resize.min',
  'AdminLTE./plugins/flot/jquery.flot.pie.min',
  'AdminLTE./plugins/flot/jquery.flot.categories.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
     var bar_data = {
      <?php echo "data: [['Janvier' ,$sommeMois[0]],['Février' ,$sommeMois[1]] , ['Mars' ,$sommeMois[2]], ['Avril' ,$sommeMois[3]], ['Mai' ,$sommeMois[4]], ['Juin' ,$sommeMois[5]], ['Juillet' ,$sommeMois[6]] , ['Août' ,$sommeMois[7]], ['Septembre' ,$sommeMois[8]], ['Octobre' ,$sommeMois[9]], ['Novembre' ,$sommeMois[10]],['Décembre' ,$sommeMois[11]]]";?>,
      color: "#1abcce"
    };
    $.plot("#bar-chart", [bar_data], {
      grid: {
        borderWidth: 1,
        borderColor: "#f3f3f3",
        tickColor: "#f3f3f3"
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.5,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });

  });


</script>
<?php $this->end(); ?>
