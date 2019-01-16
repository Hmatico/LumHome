// Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['bar'], 'language': 'fr'});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      $(document).ready(drawChart);
      $("#habitation").change(drawChart);
      $("#periode").change(drawChart);
      
      function drawChart() {
          
        var jsonData = $.ajax({
          url: "../index.php",
          method : "POST",
          data: {q:$("#habitation").val(), periode :$("#periode").val(), controle : "getStatsData", action :"getData"},
          dataType: "json",
          async: false,
          }).responseText;
          
        //$("#result_json").html(jsonData);
        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);

        // Set chart options
        var options = {chart: {title:'Heures cumulées d\'utilisation inutile'},
                       hAxis:{
                           format:'d MMM yy'
                       },
                       backgroundColor: { fill:'transparent' }
                      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }