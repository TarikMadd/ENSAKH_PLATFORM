<!-- Content Header (Page header) -->
<?php use Cake\Routing\Router; ?>
    <section class="content-header">
      <h1>
        Statistiques des Pré Inscriptions
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php foreach ($concour as $cncr): ?>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h5><?= $cncr->nbrPreinscription ." Pré Inscriptions"?></h4>

              <p><?= $cncr->niv." ".$cncr->fil ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
            <?= $this->Html->link(__('Plus d\'infos<i class="fa fa-arrow-circle-right"></i>'), ['action' => 'listePreinscrisConcoursById', $cncr->id], ['class'=>'small-box-footer','escape' => false]) ?>
          </div>
        </div>
       <?php endforeach; ?>
      </div>
    
      <div class="row">
        <div class="col-md-6">
         
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Nombre d'inscriptions par Concours</h3>

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
          <!-- /.box -->

          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Nombre des admis par Concours</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart2" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->

        <div class="col-md-6">
  
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Nombre des Présélectionnés par Concours</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart1" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Listes d'attente par Concours</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart3" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php
$resultsArr = array();
  foreach ($concour as $cncr): 
        $resultsArr[] = array('lbl' =>$cncr->nbrPreinscription , 'val' => $cncr->niv." ".$cncr->fil);
  endforeach; 

  $resultsArr1 = array();
  foreach ($concour1 as $cncr1): 
        $resultsArr1[] = array('lbl' =>$cncr1->nbrPreinscription , 'val' => $cncr1->niv." ".$cncr1->fil);
  endforeach;

  $resultsArr2 = array();
  foreach ($concour2 as $cncr2): 
        $resultsArr2[] = array('lbl' =>$cncr2->nbrPreinscription , 'val' => $cncr2->niv." ".$cncr2->fil);
  endforeach;

  $resultsArr3 = array();
  foreach ($concour3 as $cncr3): 
        $resultsArr3[] = array('lbl' =>$cncr3->nbrPreinscription , 'val' => $cncr3->niv." ".$cncr3->fil);
  endforeach;


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

    /*
     * BAR CHART
     * ---------
     */
     var arr = <?php echo json_encode( $resultsArr ) ?>;
     var arr1 = <?php echo json_encode( $resultsArr1 ) ?>;
     var arr2 = <?php echo json_encode( $resultsArr2 ) ?>;
     var arr3 = <?php echo json_encode( $resultsArr3 ) ?>;
     
    var donnee = [];
    $.each(arr,function(k,v){
      donnee.push([v['val'], v['lbl']]);
       });

    /*console.log(arr);
    console.log(bar_data);
    console.log(donnee);*/

    var bar_data = {
      data: donnee,
      color: "#3c8dbc"
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
    /* END BAR CHART */

    var donnee1 = [];
    $.each(arr1,function(k,v){
      donnee1.push([v['val'], v['lbl']]);
       });

    /*console.log(arr);
    console.log(bar_data);
    console.log(donnee);*/

    var bar_data1 = {
      data: donnee1,
      color: "#3c8dbc"
    };

    $.plot("#bar-chart1", [bar_data1], {
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
    /* END BAR CHART */

    var donnee2 = [];
    $.each(arr2,function(k,v){
      donnee2.push([v['val'], v['lbl']]);
       });

    /*console.log(arr);
    console.log(bar_data);
    console.log(donnee);*/

    var bar_data2 = {
      data: donnee2,
      color: "#3c8dbc"
    };

    $.plot("#bar-chart2", [bar_data2], {
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
    /* END BAR CHART */

    var donnee3 = [];
    $.each(arr3,function(k,v){
      donnee3.push([v['val'], v['lbl']]);
       });

    /*console.log(arr);
    console.log(bar_data);
    console.log(donnee);*/

    var bar_data3 = {
      data: donnee3,
      color: "#3c8dbc"
    };

    $.plot("#bar-chart3", [bar_data3], {
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
    /* END BAR CHART */

  });

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + "<br>"
        + Math.round(series.percent) + "%</div>";
  }
</script>
<?php $this->end(); ?>
