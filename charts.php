
<?php

session_start();

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if($_SESSION['logged']===false){
    header('Location: index.php');
}

require_once 'scripts/php/verifydata.php';

require_once 'layout/header.html';

require_once 'layout/charts.html';

if($length<=10)
    {
    echo 'THERE ARE NOT SUFFICIENT DATA TO GENERATE A CHART';
    }
else{
    require_once 'scripts/php/charts_script.php';
    }

require_once 'layout/footer.html';