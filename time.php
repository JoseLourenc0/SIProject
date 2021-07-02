<?php 
    
	$pdo = new PDO('mysql:host=localhost; dbname=banco;','root','');

	$stm= $pdo->prepare('SELECT * FROM tb_estado ORDER BY id DESC LIMIT 1');
	$stm->execute();

	if($stm->rowCount()>=1){
		echo ($stm->fetch(PDO::FETCH_ASSOC)['timeesp']);
	}else{
		echo ('Nenhum registro encontrado');
	}

 ?>