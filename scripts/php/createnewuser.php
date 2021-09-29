<?php 

	$username = addslashes($_POST['username']);
	$name = addslashes($_POST['name']);
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
    $permission = addslashes($_POST['permission']);
	
	require_once 'conn.php';

    if(isset($username) && isset($name) && isset($email) && isset($password) && isset($permission)){
        try{
            $stm= $pdo->prepare('INSERT INTO tb_user (user_name,name,user_email,user_password,user_permission,creation_date) VALUES (:t1,:t2,:t3,:t4,:t5,NOW())');
            $stm->bindValue(':t1', $username);
            $stm->bindValue(':t2', $name);
            $stm->bindValue(':t3', $email);
            $stm->bindValue(':t4', md5(md5($password)));
            $stm->bindValue(':t5', $permission);
            $stm->execute();

            if($stm->rowCount()>=1){
                echo 1;
            }else{
                echo 0;
            }
            $pdo = null;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
	
    