<?php 

	$text=$_POST['text'];
	$dhtemperature=$_POST['dhtemperature'];
	$dhumidity=$_POST['dhumidity'];
	$shumidity=$_POST['shumidity'];
	
	$pdo = new PDO('mysql:host=localhost; dbname=db_siproject;','root','');

	$stm= $pdo->prepare('INSERT INTO tb_teste (shumidity,dhumidity,dtemperature,texto,nowf) VALUES (:sh,:dh,:dt,:te,NOW())'); //DATE_SUB(NOW(),INTERVAL 3 HOUR) for -3h UTC or depending what is the default time of your remote webserver
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




 ?>