<!-- page content -->
          <div class="right_col" role="main">
            <div class="container">
              <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Statistiques des fonctionnaires par date de recrutement </h4>
                    
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
      <?php foreach ($date as $date): ?>    
			{ y: <?php echo $date['nombre']; ?>,  label: " <?php echo $date['date']; ?>" },
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
