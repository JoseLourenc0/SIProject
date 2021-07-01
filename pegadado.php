<?php 
	header('Content-Type: application/json');

	$pdo = new PDO('mysql:host=localhost; dbname=banco;','root','');

	$stm= $pdo->prepare('SELECT * FROM tb_estado ORDER BY id DESC LIMIT 1');
	$stm->execute();

	if($stm->rowCount()>=1){
		echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	}else{
		echo json_encode('Nenhum registro encontrado');
	}

 ?>