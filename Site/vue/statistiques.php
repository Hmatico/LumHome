<html>
<head>
</head>
<body>
    <form>
        <select id="habitation">
            <option value="">Selectionner un habitat</option>
            <?php
                include "../modele/afficherHabitatsDispoStats.php";
            ?>
        </select>
    </form>
    <div id="result_json"></div>
  <center><div id='chart_div' style="width: 1500px; height: 700px;"></div></center>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="javaScript/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['bar'], 'language': 'fr'});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      $("#habitation").change(drawChart);
      
      function drawChart() {
          
        var jsonData = $.ajax({
          url: "../modele/getStatsData.php",
          data: "q=" + $("#habitation").val(),
          dataType: "json",
          async: false,
          }).responseText;        

        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);

        // Set chart options
        var options = {chart: {title:'Test titre'},
                      hAxis:{
                          format: 'd MMM yy'
                      }};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</html>