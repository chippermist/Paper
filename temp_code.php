<script type="text/javascript">
        <?php

        while($row = mysql_fetch_array($services_result_mos_filter_2016, MYSQL_ASSOC)){
            $label_array[] = $row['Service'];
            $data_points[] = $row['Total'];
        }

        ?>

        var temp_labels = <?php echo json_encode($label_array); ?>;
        var temp_points = <?php echo json_encode($data_points); ?>;
        var temp_colors = [];
        
        for (i = 0; i < temp_points.length; i++) { 
            temp_colors.push(randomColor({luminosity: 'dark'}));
        }

        var pieData = {
            labels : temp_labels,
            datasets: [
            {
                backgroundColor: temp_colors,
                data: temp_points
            }
            ]
        };

        var doughnutOptions = {
          legend: {display: false, position: 'bottom'},
          animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function () {
              var ctx = this.chart.ctx;
              ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
              ctx.textAlign = 'center';
              ctx.textBaseline = 'bottom';

              this.data.datasets.forEach(function (dataset) {

                for (var i = 0; i < dataset.data.length; i++) {
                  var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                  total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                  mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                  start_angle = model.startAngle,
                  end_angle = model.endAngle,
                  mid_angle = start_angle + (end_angle - start_angle)/2;

                  var x = mid_radius * Math.cos(mid_angle);
                  var y = mid_radius * Math.sin(mid_angle);

                  ctx.fillStyle = '#fff';
                  // if (i == 3){ // Darker text color for lighter background
                  //   ctx.fillStyle = '#444';
                  // }
                  var percent = String((dataset.data[i]/total*100).toFixed(1)) + "%";
                  ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                  // Display percent in another line, line break doesn't work for fillText
                  ctx.fillText(percent, model.x + x, model.y + y + 15);
              }
          });               
          }
      }
  };

  function pieChart() {
    var myNewChart = new Chart("pieChart", {
        type: 'doughnut',
        data: pieData,
        options: doughnutOptions

    })
};


addFunctionOnWindowLoad(pieChart);
</script>