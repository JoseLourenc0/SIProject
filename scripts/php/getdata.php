<?php 
	header('Content-Type: application/json');

try{
	$pdo = new PDO('mysql:host=localhost; dbname=db_siproject;','root','');

	$stm= $pdo->prepare('SELECT state FROM tb_state ORDER BY id DESC LIMIT 1');
	$stm->execute();

	if($stm->rowCount()>=1){
		echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	}else{
		echo json_encode('State not found');
	}
}catch(PDOException $e){
	echo $e->getMessage();
}