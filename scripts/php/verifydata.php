<?php

require_once 'conn.php';
					
$stm = $pdo->prepare('SELECT COUNT(*) AS length FROM tb_history');
$stm -> execute();
$length = ($stm->fetchAll(PDO::FETCH_ASSOC)[0]['length']);