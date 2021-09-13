
<?php

session_start();

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if($_SESSION['logged']===false){
    header('Location: index.php');
}

require_once 'layout/header.html';

require_once 'layout/charts.html';

require_once 'layout/footer.html';