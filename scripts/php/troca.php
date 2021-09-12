<?php 

header('Content-Type: application/json');

$state = addslashes($_POST['state']);
$time = addslashes($_POST['time']);
$statephp = (int)$state;

if(isset($state) && isset($time)){

	try{

		$pdo = new PDO('mysql:host=localhost; dbname=db_siproject;','root','');

		$stm=$pdo->prepare('INSERT INTO tb_state (state,dh,timeesp) VALUES (:es,NOW(),:ti)');
		//$stm=$pdo->prepare('INSERT INTO tb_state (state,dh) VALUES (:es,NOW())');//DATE_SUB(NOW(),INTERVAL 3 HOUR) para -3h

		$stm->bindValue(':es',$statephp);
		$stm->bindValue(':ti',$time);
		$stm->execute();

		if($stm->rowCount()>=1){
			echo 1;
		}else{
			echo 0;
		}

		$pdo = null;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}