<?php 
header('Content-Type: application/json');


	$estado = $_POST['estado'];
	$time = $_POST['time'];
	$estadophp = (int)$estado;

	$pdo = new PDO('mysql:host=localhost; dbname=banco;','root','');

	$stm=$pdo->prepare('INSERT INTO tb_estado (estado,dh,timeesp) VALUES (:es,NOW(),:ti)');
	//$stm=$pdo->prepare('INSERT INTO tb_estado (estado,dh) VALUES (:es,NOW())');//DATE_SUB(NOW(),INTERVAL 3 HOUR) para -3h

	$stm->bindValue(':es',$estadophp);
	$stm->bindValue(':ti',$time);
	$stm->execute();

	if($stm->rowCount()>=1){
		echo json_encode('Registro realizado');
	}else{
		echo json_encode('Falha ao salvar registro '.$estadophp);
	}

    $pdo = null;


 ?>