<?php 
	header('Content-Type: application/json');

	require_once 'conn.php';
try{

	$stm= $pdo->prepare('SELECT state,timeesp FROM tb_state ORDER BY id DESC LIMIT 1');
	$stm->execute();

	if($stm->rowCount()>=1){
		echo json_encode($stm->fetch(PDO::FETCH_ASSOC));
	}else{
		echo json_encode('State not found');
	}
}catch(PDOException $e){
	echo $e->getMessage();
}