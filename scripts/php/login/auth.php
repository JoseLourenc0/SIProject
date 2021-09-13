<?php 

	session_start();

	$_SESSION['logged'] = false;
	$_SESSION['fa'] = false;

	$name = addslashes($_POST['name']);
	$password = addslashes($_POST['password']);

	if(isset($name) && isset($password)){

		require_once '../conn.php';

		$stm= $pdo->prepare('SELECT * FROM tb_user WHERE user_name = :usrname AND user_password = :usrpass');
		$stm ->bindValue(':usrname',$name);
		$stm ->bindValue(':usrpass',md5(md5($password)));
        $stm->execute();

		if($stm->rowCount()>=1){

			$_SESSION['logged'] = true;
			$_SESSION['name'] = $stm->fetchAll(PDO::FETCH_ASSOC)[0]['name'];
			$_SESSION['fa'] = true;
			echo ($_SESSION['logged']);

		}else{

			$_SESSION['logged'] = false;

		}
        header('Location: ../../../index.php');

		$pdo=null;

	}