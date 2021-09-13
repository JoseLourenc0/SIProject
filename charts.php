
<?php

session_start();

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if($_SESSION['logged']===false){
    header('Location: index.php');
}

require_once 'layout/header.html';

require_once 'layout/charts.html';
echo '<br><br>
    <a style="text-align: center;" href="scripts/php/login/logout.php"><h4>LOGOUT</h4></a>';

require_once 'layout/footer.html';