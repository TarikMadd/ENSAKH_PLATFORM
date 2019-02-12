<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Demandes Delivrés</span>
          <span class="info-box-number"><?= $nbDelivre?><small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Demandes Pretes</span>
          <span class="info-box-number"><?= $nbPrete?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">En Cours de Traitement</span>
          <span class="info-box-number"><?= $nbEnCours?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Demandes Envoyés</span>
          <span class="info-box-number"><?= $nbDemande ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
   <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- MAP & BOX PANE -->

          <!-- /.box-header -->

        <!-- /.box -->
        <div class="row">
          <div class="col-md-6">
            <!-- DIRECT CHAT -->
            <div class="box box-warning direct-chat direct-chat-warning">
              <div class="box-header with-border">
                <h3 class="box-title">Statistiques</h3>

                <div class="box-tools pull-right">
                  <span data-toggle="tooltip" title="<?= $nbDemande ?> Nouvelles Demandes" class="badge bg-yellow"><?=$nbDemande?></span>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>

                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->

                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">

                    </div>
                    <!-- /.direct-chat-info -->

                <!--/.direct-chat-messages-->

          <!-- /.col -->

        <!-- /.info-box -->

        <div class="box box-default">

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <div class="chart-responsive">
                  <canvas id="pieChart" height="150"></canvas>
                </div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.col -->
             <center> <div class="col-md-4">
                <ul class="chart-legend clearfix">
                  <li><i class="fa fa-circle-o text-Red"></i>Attestation de Travail</li>
                  <li><i class="fa fa-circle-o text-yellow"></i>Fiche de Salaire</li>
                  <li><i class="fa fa-circle-o text-green"></i>Fiche d'absence</li>

                </ul>
              </div></center>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->

        <!-- /.box -->

        <!-- PRODUCT LIST -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Recently Added Products</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <ul class="products-list product-list-in-box">
            <?php
            $i=0;
            foreach($lastDemande as $demande)
            {
            ?><li class="item">
                            <div class="product-img">
                            <?php echo $this->Html->image('157.jpg', array('alt' => 'Product Image')); ?>
                            </div>
                            <div class="product-info">
                              <a href="javascript::;" class="product-title"><?php if (isset($demande['nom_prof'])){echo $demande['nom_prof'].' '.$demande['prenom_prof']; }?>
                                <span></span></a>
                                  <span class="product-description">
                                    <?php if(isset($demande['nomDocument'])){echo $demande['nomDocument'];$i++;}?>
                                  </span>
                            </div>
                          </li>
                          <?php
            }?>
  </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="javascript::;" class="uppercase"><?php if($i>=1){ echo $this->Html->link(__('Voir Tous les documents ...'), ['action' => 'voirNouveau'], ['class'=>'btn btn-info btn-xs']  );
  }else{echo 'Pas de Nouvelles';}?></a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-md-12">

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <p class="text-center">
                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
              </p>

              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="salesChart" style="height: 180px;"></canvas>
              </div>
              <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <p class="text-center">
                <strong>Goal Completion</strong>
              </p>

              <div class="progress-group">
                <span class="progress-text">Add Products to Cart</span>
                <span class="progress-number"><b>160</b>/200</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                </div>
              </div>
              <!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Complete Purchase</span>
                <span class="progress-number"><b>310</b>/400</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                </div>
              </div>
              <!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Visit Premium Page</span>
                <span class="progress-number"><b>480</b>/800</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                </div>
              </div>
              <!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Send Inquiries</span>
                <span class="progress-number"><b>250</b>/500</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                </div>
              </div>
              <!-- /.progress-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>


  <!-- Main row -->

  <!-- /.row -->
</section>
<!-- /.content -->

<?php
$this->Html->css([
    'AdminLTE./plugins/iCheck/flat/blue',
    'AdminLTE./plugins/morris/morris',
    'AdminLTE./plugins/jvectormap/jquery-jvectormap-1.2.2',
    'AdminLTE./plugins/datepicker/datepicker3',
    'AdminLTE./plugins/daterangepicker/daterangepicker-bs3',
    'AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/sparkline/jquery.sparkline.min',
  'AdminLTE./plugins/jvectormap/jquery-jvectormap-1.2.2.min',
  'AdminLTE./plugins/jvectormap/jquery-jvectormap-world-mill-en',
  'AdminLTE./plugins/chartjs/Chart.min',

],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
    <script type="text/javascript">
      //-----------------------
      //- MONTHLY SALES CHART -
      //-----------------------

      // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var salesChart = new Chart(salesChartCanvas);

      var salesChartData = {
        labels: ["2016-2017","S", "MS", "April", "May", "June", "July"],
        datasets: [

          {
            label: "Digital Goods",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: [30, 48, 40, 19, 86, 27, 90]
          }
        ]
      };

      var salesChartOptions = {
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
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
      };

      //Create the line chart
      salesChart.Line(salesChartData, salesChartOptions);

      //---------------------------
      //- END MONTHLY SALES CHART -
      //---------------------------

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas);
      var PieData = [
        {
          value: <?= $nbFiche ?>,
          color: "yellow",
          highlight: "yellow",
          label: "Fiche de Salaire"
        },
        {
          value: <?= $nbAbscence ?>,
          color: "green",
          highlight: "#00c0ef",
          label: "Fiche D'abscence"
        },
        {
          value: <?= $nbAttest ?>,
          color: "black",
          highlight: "black",
          label: "Attestation"
        }

      ];
      var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth:1,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        //String - A tooltip template
        tooltipTemplate: "<%=value %>"
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);
      //-----------------
      //- END PIE CHART -
      //-----------------

        /* jVector Maps
       * ------------
       * Create a world map with markers
       */
      $('#world-map-markers').vectorMap({
        map: 'world_mill_en',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        backgroundColor: 'transparent',
        regionStyle: {
          initial: {
            fill: 'rgba(210, 214, 222, 1)',
            "fill-opacity": 1,
            stroke: 'none',
            "stroke-width": 0,
            "stroke-opacity": 1
          },
          hover: {
            "fill-opacity": 0.7,
            cursor: 'pointer'
          },
          selected: {
            fill: 'yellow'
          },
          selectedHover: {}
        },
        markerStyle: {
          initial: {
            fill: '#00a65a',
            stroke: '#111'
          }
        },
        markers: [
          {latLng: [41.90, 12.45], name: 'Vatican City'},
          {latLng: [43.73, 7.41], name: 'Monaco'},
          {latLng: [-0.52, 166.93], name: 'Nauru'},
          {latLng: [-8.51, 179.21], name: 'Tuvalu'},
          {latLng: [43.93, 12.46], name: 'San Marino'},
          {latLng: [47.14, 9.52], name: 'Liechtenstein'},
          {latLng: [7.11, 171.06], name: 'Marshall Islands'},
          {latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis'},
          {latLng: [3.2, 73.22], name: 'Maldives'},
          {latLng: [35.88, 14.5], name: 'Malta'},
          {latLng: [12.05, -61.75], name: 'Grenada'},
          {latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines'},
          {latLng: [13.16, -59.55], name: 'Barbados'},
          {latLng: [17.11, -61.85], name: 'Antigua and Barbuda'},
          {latLng: [-4.61, 55.45], name: 'Seychelles'},
          {latLng: [7.35, 134.46], name: 'Palau'},
          {latLng: [42.5, 1.51], name: 'Andorra'},
          {latLng: [14.01, -60.98], name: 'Saint Lucia'},
          {latLng: [6.91, 158.18], name: 'Federated States of Micronesia'},
          {latLng: [1.3, 103.8], name: 'Singapore'},
          {latLng: [1.46, 173.03], name: 'Kiribati'},
          {latLng: [-21.13, -175.2], name: 'Tonga'},
          {latLng: [15.3, -61.38], name: 'Dominica'},
          {latLng: [-20.2, 57.5], name: 'Mauritius'},
          {latLng: [26.02, 50.55], name: 'Bahrain'},
          {latLng: [0.33, 6.73], name: 'São Tomé and Príncipe'}
        ]
      });

        /* SPARKLINE CHARTS
       * ----------------
       * Create a inline charts with spark line
       */

      //-----------------
      //- SPARKLINE BAR -
      //-----------------
      $('.sparkbar').each(function () {
        var $this = $(this);
        $this.sparkline('html', {
          type: 'bar',
          height: $this.data('height') ? $this.data('height') : '30',
          barColor: $this.data('color')
        });
      });

      //-----------------
      //- SPARKLINE PIE -
      //-----------------
      $('.sparkpie').each(function () {
        var $this = $(this);
        $this.sparkline('html', {
          type: 'pie',
          height: $this.data('height') ? $this.data('height') : '90',
          sliceColors: $this.data('color')
        });
      });

      //------------------
      //- SPARKLINE LINE -
      //------------------
      $('.sparkline').each(function () {
        var $this = $(this);
        $this.sparkline('html', {
          type: 'line',
          height: $this.data('height') ? $this.data('height') : '90',
          width: '100%',
          lineColor: $this.data('linecolor'),
          fillColor: $this.data('fillcolor'),
          spotColor: $this.data('spotcolor')
        });
      });

    </script>
<?php $this->end(); ?>