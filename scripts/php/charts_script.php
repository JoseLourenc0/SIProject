<script>
//CHART 1
		google.charts.load('current',{'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart(){
			var data = google.visualization.arrayToDataTable([
				['DATE','Air Humidity', 'Air Temperature'],
				<?php 
					require_once 'conn.php';
					
	                $stm= $pdo->prepare('SELECT * FROM tb_history ORDER BY id DESC LIMIT 100');
	                $stm->execute();
	                $data = array_reverse($stm->fetchAll(PDO::FETCH_ASSOC));
					for($i=0;$i<sizeof($data);$i++){
						$airTemp = $data[$i]['dtemperature'];
						$airHum = $data[$i]['dhumidity'];
						$date = $data[$i]['nowf'];
				 ?>
				 ['<?php echo $date ?>',<?php echo $airHum ?>,<?php echo $airTemp ?>],
				<?php } ?>
				]);

			var options = {
				title: 'DATE x Air Temperature (°C) (Last 100 reads)',
				legend: { position: 'right'}
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart1'));

			chart.draw(data,options);
		}
    //CHART 1
    //CHART 2
        google.charts.load('current',{'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart2);

		function drawChart2(){
			var data = google.visualization.arrayToDataTable([
				['DATE', 'Air Humidity'],
				<?php 
	                $stm= $pdo->prepare('SELECT * FROM tb_history ORDER BY id DESC LIMIT 100');
	                $stm->execute();
	                $data = array_reverse($stm->fetchAll(PDO::FETCH_ASSOC));
					for($i=0;$i<sizeof($data);$i++){
						$airHum = $data[$i]['dhumidity'];
						$date = $data[$i]['nowf'];
				 ?>
				 ['<?php echo ($date) ?>',<?php echo ($airHum) ?>],
				<?php } ?>
				]);

			var options = {
				title: 'DATE x Air Humidity (%) (Last 100 reads)',
				legend: { position: 'right'}
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart2'));

			chart.draw(data,options);
		}
    //CHART 2
    //CHART 3
        google.charts.load('current',{'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart3);

		function drawChart3(){
			var data = google.visualization.arrayToDataTable([
				['DATE','Air Humidity', 'Air Temperature', 'Soil Moisture'],
				<?php 
	                $stm= $pdo->prepare('SELECT * FROM tb_history ORDER BY id DESC LIMIT 100');
	                $stm->execute();
	                $data = array_reverse($stm->fetchAll(PDO::FETCH_ASSOC));
					for($i=0;$i<sizeof($data);$i++){
						$airTemp = $data[$i]['dtemperature'];
						$airHum = $data[$i]['dhumidity'];
						$soilMoist = $data[$i]['shumidity'];
						$date = $data[$i]['nowf'];
				 ?>
				 ['<?php echo $date ?>',<?php echo $airHum ?>,<?php echo $airTemp ?>,<?php echo $soilMoist ?>],
				<?php } ?>
				]);

			var options = {
				title: 'General Data',
				legend: { position: 'right'}
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart3'));

			chart.draw(data,options);
		}
    //CHART 3
</script>