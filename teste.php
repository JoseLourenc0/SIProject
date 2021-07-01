<?php 

	$texto=$_POST['texto'];
	$dhtemperature=$_POST['dhtemperature'];
	$dhumidity=$_POST['dhumidity'];
	$shumidity=$_POST['shumidity'];
	
	$pdo = new PDO('mysql:host=localhost; dbname=banco;','root','');

	$stm= $pdo->prepare('INSERT INTO tb_teste (shumidity,dhumidity,dtemperature,texto,nowf) VALUES (:sh,:dh,:dt,:te,NOW())'); //DATE_SUB(NOW(),INTERVAL 3 HOUR) para -3h
	$stm->bindValue(':sh', $shumidity);
	$stm->bindValue(':dh', $dhumidity);
	$stm->bindValue(':dt', $dhtemperature);
	$stm->bindValue(':te', $texto);
	$stm->execute();

	if($stm->rowCount()>=1){
		echo ('Registro realizado');
	}else{
		echo ('Falha ao salvar registro');
	}
    $pdo = null;




 ?>