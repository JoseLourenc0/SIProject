<?php 

	$text = addslashes($_POST['text']);
	$dhtemperature = addslashes($_POST['dhtemperature']);
	$dhumidity = addslashes($_POST['dhumidity']);
	$shumidity = addslashes($_POST['shumidity']);
	
	require_once 'conn.php';

	$stm= $pdo->prepare('INSERT INTO tb_history (shumidity,dhumidity,dtemperature,description,nowf) VALUES (:sh,:dh,:dt,:te,NOW())'); //DATE_SUB(NOW(),INTERVAL 3 HOUR) for -3h UTC or depending what is the default time of your remote webserver
	$stm->bindValue(':sh', $shumidity);
	$stm->bindValue(':dh', $dhumidity);
	$stm->bindValue(':dt', $dhtemperature);
	$stm->bindValue(':te', $text);
	$stm->execute();

	if($stm->rowCount()>=1){
		echo ('Data inserted succesfully');
	}else{
		echo ('Failed inserting data');
	}
    $pdo = null;