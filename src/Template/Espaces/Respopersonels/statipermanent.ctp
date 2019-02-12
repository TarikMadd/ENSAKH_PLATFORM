vous etes connectes en respopersonnel

<!-- Content Header (Page header) -->
<?php use Cake\Routing\Router; ?>
    <section class="content-header">
      <h1>
        Statistiques des professeurs permanents
        
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      
    
      <div class="row">
        <div class="col-md-6">

         
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Statistiques des professeurs permanents par Grades</h3>

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
</div>

          <!--tanya-->
           <!-- Bar chart -->
           <div class="col-md-6">

          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Statistiques des professeurs permanents par Departement</h3>

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
          </div>

          <!-- /.box -->

          
          
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php
$resultsArr = array();
  foreach ($profpermanent as $vct): 
        $resultsArr[] = array('lbl' =>$vct->nbrGrades , 'val' => $vct->grd);
  endforeach;

  $resultsArr2 = array();
  foreach ($profpermanentdep as $vct): 
        $resultsArr2[] = array('lbl' =>$vct->nbrDep , 'val' => $vct->dep);
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
      var arr2 = <?php echo json_encode( $resultsArr2 ) ?>;
     
     
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

    var donnee2 = [];
    $.each(arr2,function(k,v){
      donnee2.push([v['val'], v['lbl']]);
       });

    /*console.log(arr);
    console.log(bar_data);
    console.log(donnee);*/

    var bar_data2= {
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
