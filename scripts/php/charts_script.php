//CHART 1
		google.charts.load('current',{'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart(){
			var data = google.visualization.arrayToDataTable([
				['Data Hora','Umidade do Ar', 'Temperatura do Ar'],
				<?php 
					require_once 'conn.php';
					
	                $stm= $pdo->prepare('SELECT * FROM tb_history ORDER BY id DESC LIMIT 100');
	                $stm->execute();
	                $dados = array_reverse($stm->fetchAll(PDO::FETCH_ASSOC));
					for($i=0;$i<sizeof($dados);$i++){
						$temperaturaAr = $dados[$i]['dtemperature'];
						$umidadeAr = $dados[$i]['dhumidity'];
						$dataHora = $dados[$i]['nowf'];
				 ?>
				 ['<?php echo $dataHora ?>',<?php echo $umidadeAr ?>,<?php echo $temperaturaAr ?>],
				<?php } ?>
				]);

			var options = {
				title: 'Gráfico Horário x Temperatura do Ar (°C) (Últimas 100 leituras)',
				legend: { position: 'right'}
			};

			var chart = new google.visualization.LineChart(document.getElementById('graficoLinha'));

			chart.draw(data,options);
		}
    //CHART 1
    //CHART 2
        google.charts.load('current',{'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart2);

		function drawChart2(){
			var data = google.visualization.arrayToDataTable([
				['Data Hora', 'Umidade do Ar'],
				<?php 
	                $stm= $pdo->prepare('SELECT * FROM tb_history ORDER BY id DESC LIMIT 100');
	                $stm->execute();
	                $dados = array_reverse($stm->fetchAll(PDO::FETCH_ASSOC));
					for($i=0;$i<sizeof($dados);$i++){
						$umidadeAr = $dados[$i]['dhumidity'];
						$dataHora = $dados[$i]['nowf'];
				 ?>
				 ['<?php echo ($dataHora) ?>',<?php echo ($umidadeAr) ?>],
				<?php } ?>
				]);

			var options = {
				title: 'Gráfico Horário x Umidade do Ar (%) (Últimas 100 leituras)',
				legend: { position: 'right'}
			};

			var chart = new google.visualization.LineChart(document.getElementById('graficoLinha2'));

			chart.draw(data,options);
		}
    //CHART 2
    //CHART 3
        google.charts.load('current',{'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart3);

		function drawChart3(){
			var data = google.visualization.arrayToDataTable([
				['Data Hora','Umidade do Ar', 'Temperatura do Ar', 'Umidade do Solo'],
				<?php 
	                $stm= $pdo->prepare('SELECT * FROM tb_history ORDER BY id DESC LIMIT 100');
	                $stm->execute();
	                $dados = array_reverse($stm->fetchAll(PDO::FETCH_ASSOC));
					for($i=0;$i<sizeof($dados);$i++){
						$temperaturaAr = $dados[$i]['dtemperature'];
						$umidadeAr = $dados[$i]['dhumidity'];
						$umidadeSolo = $dados[$i]['shumidity'];
						$dataHora = $dados[$i]['nowf'];
				 ?>
				 ['<?php echo $dataHora ?>',<?php echo $umidadeAr ?>,<?php echo $temperaturaAr ?>,<?php echo $umidadeSolo ?>],
				<?php } ?>
				]);

			var options = {
				title: 'Gráfico Geral',
				legend: { position: 'right'}
			};

			var chart = new google.visualization.LineChart(document.getElementById('graficoLinha3'));

			chart.draw(data,options);
		}
    //CHART 3