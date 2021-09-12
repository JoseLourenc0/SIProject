<?php 

    $pin = addslashes($_POST['pin']);

	require_once 'conn.php';

    if($pin=='brah'){

		$stm= $pdo->prepare('SELECT * FROM tb_state ORDER BY id DESC LIMIT 1');
		$stm->execute();

		if($stm->rowCount()>=1){
			echo ($stm->fetch(PDO::FETCH_ASSOC)['state']);
		}else{
			echo ("There's no state");
		}
	}else{
		echo('Uncorrect PIN');
	}