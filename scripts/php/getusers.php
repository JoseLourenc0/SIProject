<?php 
	header('Content-Type: application/json');

	require_once 'conn.php';
try{

	$stm= $pdo->prepare('SELECT id,name,user_name,user_email,user_permission,creation_date FROM tb_user WHERE user_permission<>0 ORDER BY id DESC');
	$stm->execute();

	if($stm->rowCount()>=1){
		echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
	}else{
		echo 0;
	}
}catch(PDOException $e){
	echo $e->getMessage();
}