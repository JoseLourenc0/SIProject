<?php 
header('Content-Type: application/json');


	$state = $_POST['state'];
	$time = $_POST['time'];
	$statephp = (int)$state;

	$pdo = new PDO('mysql:host=localhost; dbname=db_siproject;','root','');

	$stm=$pdo->prepare('INSERT INTO tb_state (state,dh,timeesp) VALUES (:es,NOW(),:ti)');
	//$stm=$pdo->prepare('INSERT INTO tb_state (state,dh) VALUES (:es,NOW())');//DATE_SUB(NOW(),INTERVAL 3 HOUR) para -3h

	$stm->bindValue(':es',$statephp);
	$stm->bindValue(':ti',$time);
	$stm->execute();

	if($stm->rowCount()>=1){
		echo json_encode('Registro realizado');
	}else{
		echo json_encode('Falha ao salvar registro '.$statephp);
	}

    $pdo = null;


 ?>