<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <a href="kawtarNb" class="small-box-footer">
                <div class="small-box" style="background-color:#A2C11C; color: #fff">
                    <div class="inner">
                        <h3><?= $nbper; ?></h3>

                        <p>Total des professeurs permanents</p>

                    </div>
                    <div class="icon">
                        <i class="fa fa-tags"></i>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="kawtarNBMas" class="small-box-footer">
                <div class="small-box" style="background-color: #51A5CA ; color: #fff">
                    <div class="inner">
                        <h3><?= $nbHomme; ?></h3>

                        <p>Total des professeurs permanents masculins</p>

                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="kawtarNBFem" class="small-box-footer">
                <div class="small-box" style="background-color: #55DCDC; color: #fff">
                    <div class="inner">
                        <h3><?= $nbFemme; ?></h3>
                        <p>Total des professeurs permanents féminins</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="kawtarNBage" class="small-box-footer">
                <div class="small-box" style="background-color: #EAB607; color: #fff">
                    <div class="inner">
                        <h3><?= $ageinf; ?></h3>
                        <p>des professeurs permanents moins de 40 ans</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="kawtarNBAAGE" class="small-box-footer">
                <div class="small-box" style="background-color:#C576AC ; color: #fff">
                    <div class="inner">
                        <h3><?= $agesup; ?></h3>
                        <p>des professeurs permanents plus de 40 ans</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </a>
        </div>













        </div>
    
    </div>
</section>
<?php
$this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.min', ['block' => 'css']);
$this->Html->css('AdminLTE./plugins/fullcalendar/fullcalendar.print', ['block' => 'css', 'media' => 'print']);

$this->Html->script([
    'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
    'AdminLTE./plugins/fullcalendar/fullcalendar.min',
],
    ['block' => 'script']);
?>
<?php
$this->Html->script([
    'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
    'AdminLTE./plugins/flot/jquery.flot.min',
    'AdminLTE./plugins/flot/jquery.flot.resize.min',
    'AdminLTE./plugins/flot/jquery.flot.pie.min',
    'AdminLTE./plugins/flot/jquery.flot.categories.min',
    'AdminLTE./plugins/chartjs/Chart.min',
],
    ['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
    $(function () {
        function ini_events(ele) {
            ele.each(function () {

                var eventObject = {
                    title: $.trim($(this).text())
                };
                $(this).data('eventObject', eventObject);


            });
        }

        ini_events($('#external-events div.external-event'));
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: "Aujourd'hui",
                month: 'Mois',
                week: 'Semaines',
                day: 'jours'
            },
            events: [
                <?php for($i=0;$i<count($date);$i++) { ?>
                {
                    title: '<?= $date[$i]['titre'] ?>',
                    start: new Date("<?= $date[$i]['year'] ?>, <?= $date[$i]['mois'] ?>, <?= $date[$i]['jourDebut'] ?>"),
                    end: new Date("<?= $date[$i]['yearFin'] ?>, <?= $date[$i]['moisFin'] ?>, <?= $date[$i]['jourFin']?>"),
                    backgroundColor: "<?php echo array_rand($couleurs,1) ?>",
                    borderColor: "#2A3F54"
                },
                <?php } ?>
            ],
        });

    });

</script>
<!-- page script -->
<script>
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: <?php echo $res['gradesfct']; ?>,
                color: "#f56954",
                highlight: "#f56954",
                label: "Administrateur"
            },
            {
                value: <?php echo $res['gradesfct1']; ?>,
                color: "#A2C11C",
                highlight: "#A2C11C",
                label: "Ingénieur"
            },
            {
                value: <?php echo $res['gradesfct2']; ?>,
                color: "blue",
                highlight: "blue",
                label: "Technicien"
            },
            {
                value: <?php echo $res['gradesfct3']; ?>,
                color: "blue",
                highlight: "blue",
                label: "Aide Technicien"
            },
            {
                value: <?php echo $res['gradesfct4']; ?>,
                color: "blue",
                highlight: "blue",
                label: "Aide Administrateur"
            },


        ];
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);






    });
    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
        data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
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
</script>

<?php  $this->end(); ?>
