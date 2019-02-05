<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <a href="badrconsulterOuvrages" class="small-box-footer">
                <div class="small-box" style="background-color: #336E7B; color: #fff">
                    <div class="inner">
                        <h3><?= $res['nbrE']; ?></h3>
                        <p>Total Etudiants</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="hajarreservation" class="small-box-footer">
                <div class="small-box" style="background-color: #66CC99; color: #fff">
                    <div class="inner">
                        <h3><?= $res['nbrP']; ?></h3>
                        <p>Total proffesseur</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="majdaemprunte" class="small-box-footer">
                <div class="small-box" style="background-color: #F9BF3B; color: #fff">
                    <div class="inner">
                        <h3><?= $res['nbrC']; ?></h3>
                        <p>Total classes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tags"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-xs-6">
            <a href="majdaemprunte" class="small-box-footer">
                <div class="small-box" style="background-color: #F64747; color: #fff">

                <div class="inner">
                        <h3><?= $res['nbrN']; ?></h3>
                        <p>Total niveaux</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tags"></i>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <div class="item  col-xs-6 col-lg-6">
        <div class="thumbnail">
            <canvas id="pieChart" style="height:250px"></canvas>
            <div class="caption">
                <h4 class="group inner list-group-item-heading">
                    Nombre d'étudiant par classe</h4>
                <p class="group inner list-group-item-text">
                    Ce Graphe présente la statistique qui concerne le nombre d'étudiants par classe à <strong>l'ENSA Khouribga.</strong></p>
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
                value: <?php echo $res['premiere_annee']; ?>,
                color: "#f56954",
                highlight: "#f56954",
                label: "premiere_annee"
            },
            {
                value: <?php echo $res['deuxiemme_annee']; ?>,
                color: "blue",
                highlight: "blue",
                label: "deuxiemme_annee"
            },
            {
                value: <?php echo $res['TC']; ?>,
                color: "yellow",
                highlight: "yellow",
                label: "TC"
            },
            {
                value: <?php echo $res['_4GE']; ?>,
                color: "black",
                highlight: "#black",
                label: "2GE"
            },
            {
                value: <?php echo $res['_4GI']; ?>,
                color: "red",
                highlight: "red",
                label: "2GI"
            },
            {
                value: <?php echo $res['_4GPE']; ?>,
                color: "green",
                highlight: "green",
                label: "2GPE"
            },
            {
                value: <?php echo $res['_4GRT']; ?>,
                color: "grey",
                highlight: "grey",
                label: "2GRT"
            },
            {
                value: <?php echo $res['_5GE']; ?>,
                color: "brown",
                highlight: "brown",
                label: "3GE"
            },
            {
                value: <?php echo $res['_5GI']; ?>,
                color: "#BDB76B",
                highlight: "#BDB76B",
                label: "3GI"
            },
            {
                value: <?php echo $res['_5GPE']; ?>,
                color: "#9932CC",
                highlight: "#9932CC",
                label: "3GPE"
            },
            {
                value: <?php echo $res['_5GRT']; ?>,
                color: "#F5DEB3",
                highlight: "#F5DEB3",
                label: "3GRT"
            },
            {
                value: <?php echo $res['_3GPE']; ?>,
                color: "#F5F5DC",
                highlight: "#F5F5DC",
                label: "1GPE"
            }

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
