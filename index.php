<?php
/*
 * PHP fajl za potrebe članka u Svetu Kompjutera
 * Author: Petrović Dejan
 * Date: 31/12/2017
 * Wemos D1, LM35
 */
include "connect_to_mysql.php"; // php fajl preko koga ćemo se konektovati na bazu podataka
$output = '';
$chartOutput='';
if(isset($_GET['lm35']) && $_GET['lm35'] != ""){
	$lm35=strip_tags(stripslashes(mysqli_real_escape_string($con,$_GET['lm35'])));
	mysqli_query($con,"INSERT INTO test SET sensor = 'lm35', value = '$lm35', date=now()");
}
$sql = mysqli_query($con,"SELECT * FROM test WHERE sensor='lm35' ORDER by 'date' DESC") or die(mysqli_error());
$count = mysqli_num_rows($sql);
if($count > 0){
     while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
             $id = $row["id"];
			 $value = $row["value"];
			 $date = strftime("%X", strtotime($row["date"]));
			 $output .="['".$date."',".$value."],";
			 $chartOutput = rtrim($output, ",");
	 }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Arduino - no limits</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Vreme', 'LM35'],
          <?php echo $chartOutput; ?>
        ]);

        var options = {
          title: 'Očitavanje temperature van lokalne mreže',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

</head>

<body>
<div id="curve_chart" style="width: 1900px; height: 500px"></div>
</body>
</html>
