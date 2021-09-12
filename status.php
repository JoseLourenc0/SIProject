<?php 
    $pin=$_POST['pin'];
    if($pin=='brah'){
	$pdo = new PDO('mysql:host=localhost; dbname=db_siproject;','root','');

	$stm= $pdo->prepare('SELECT * FROM tb_state ORDER BY id DESC LIMIT 1');
	$stm->execute();

	if($stm->rowCount()>=1){
		echo ($stm->fetch(PDO::FETCH_ASSOC)['estado']);
	}else{
		echo ("There's no state");
	}}else{echo('Uncorrect PIN');}

 ?>