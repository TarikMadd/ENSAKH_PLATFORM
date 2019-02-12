<!-- Content Header (Page header) -->
  
    <section class="content-header">
      <h1>
        Les demandes des certificats de stage
       <div id="filiereId" hidden="hidden"><?php $i=0; foreach ($filiere as $value) { echo $value['id'];if($i!=count($filiere)-1){echo" ,";} $i++; }?></div>
                
      </h1>
          </section>
<?php 
$k = 0 ;
foreach ($filiere as $value) :?>
    	<?php
    	$max = "Aucun pique";
    	$maxValue = 0;
    	$mois = [1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Decembre'];?>
    	<div id="<?= h("filiereData".$value["id"])?>" hidden="hidden" >
    	<?php
	    for($i=1;$i<13;$i++)
	    {
	    	echo $envoyemois[$value['id']][$i];
		    if ($i != 12) {
		    	echo ",";
		    }
		    if($envoyemois[$value['id']][$i]>$maxValue)
		    {
		      	$maxValue = $envoyemois[$value['id']][$i];
		        $max=$mois[$i];
		    }
	    }
	    ?>
  </div>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">La courbe de la filiére <?= h($value['libile']) ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
              	<canvas id="<?= h("areaChart".$value['id']) ?>" style="height:250px"></canvas>
          <!-- /.box -->
          <p> le pique des demandes est dans le mois: <strong> <?=h($max) ?> </strong></p>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

         

        </div>
      
      </div>
      <!-- /.row -->

    </section>
<?php 
$k++;

endforeach; ?>
    <!-- /.content -->


<?php $this->start('scriptBotton'); ?>
<script src="/admin_l_t_e/plugins/chartjs/Chart.min.js"></script><!-- page script -->
<script>
function graphe(p2,donnes) {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    
    var areaChart2Canvas2 = $("#areaChart"+p2).get(0).getContext("2d");

    // This will get the first returned node in the jQuery collection.
    var areaChart2 = new Chart(areaChart2Canvas2);

    var areaChart2Data = {
      labels: ["January", "February", "March", "April", "May", "June", "July","Août","Septembre","October","Novembre","Decembre"],
      datasets: [
        {
          label: "Digital Goods",
          fillColor: "rgba(142, 51, 76, 0.7)",
          strokeColor: "rgba(214, 95, 95, 0.8)",
          pointColor: "#F1F08A",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(214, 95, 95, 1)",
          data: donnes
        }
        
      ]
    };

    var areaChart2Options = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart2.Line(areaChart2Data, areaChart2Options);

    //-------------
    //- LINE CHART -
    //--------------
   
    //-------------
               // The function returns the product of p1 and p2
}

var array = JSON.parse("["+$('#filiereId').text()+"]");
 for (var i = 0; i < array.length; i++) {
 	var data_array = JSON.parse("["+$('#filiereData'+array[i]).text()+"]");
 	graphe(array[i],data_array);
 }
</script>
<?php  $this->end(); ?>



    