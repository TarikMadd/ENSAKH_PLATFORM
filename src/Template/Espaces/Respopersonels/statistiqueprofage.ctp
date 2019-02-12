<!-- page content -->
          <div class="right_col" role="main">
            <div class="container">
              <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Statistiques des professeurs par age </h4>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"><br>

	   
<br>

<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;">
</div>

 
  

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: ""
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: false, 
		legendMarkerColor: "grey",
		legendText: "MMbbl = one million barrels",
		dataPoints: [  
        <?php foreach ($age1 as $age1): ?>
			{ y: <?php echo $age1['nombre']; ?>,  label: "[20 - 30] " },
		<?php endforeach; ?>
		<?php foreach ($age2 as $age2): ?>
			{ y: <?php echo $age2['nombre']; ?>,  label: "[30 - 40] " },
		<?php endforeach; ?>
		<?php foreach ($age3 as $age3): ?>
			{ y: <?php echo $age3['nombre']; ?>,  label: "[40 - 50] " },
		<?php endforeach; ?>
		<?php foreach ($age4 as $age4): ?>
			{ y: <?php echo $age4['nombre']; ?>,  label: "[50 - 60] " },
		<?php endforeach; ?>
      
		]
	}]
});
chart.render();

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



                  </div>
                </div>
              </div>


  </div></div>
           </div>
        <!-- fin page content -->
