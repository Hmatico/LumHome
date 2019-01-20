<html>
<head>
</head>
<body>
    <form>
        <select id="habitation" style="margin: 10px;">
            <?php 
            include "../modele/statsBD.php";
            echo getHabitats();
            ?>
        </select>
        <select id="periode" style="margin: 10px;">
            <option value="WEEK">Depuis une semaine</option>
            <option value="MONTH">Depuis un mois</option>
            <option value="YEAR">Depuis un an</option>
        </select>
    </form>
    <div id="result_json"></div>
  <center><div id='chart_div' style="width: 80vw; height: 70vh;"></div></center>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="javaScript/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="javaScript/stats.js"></script>
</html>