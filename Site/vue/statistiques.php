<html>
<head>
</head>
<body>
    <form>
        <select id="habitation">
            <option selected disabled >Selectionner un habitat</option>
            <?php
            //afficher toutes les habitations de l'utilisateur
                include "../controle/afficherHabitatsDispoStats.php";
            ?>
        </select>
        <select id="periode">
            <option value="WEEK">Depuis une semaine</option>
            <option value="MONTH">Depuis un mois</option>
            <option value="YEAR">Depuis un an</option>
        </select>
    </form>
    <div id="result_json"></div>
  <center><div id='chart_div' style="width: 800px; height: 400px;"></div></center>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="javaScript/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="javaScript/stats.js"></script>
</html>