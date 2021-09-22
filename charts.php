
<?php

session_start();

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if($_SESSION['logged']===false){
    header('Location: index.php');
}

require_once 'scripts/php/verifydata.php';

require_once 'layout/header.html';

if($length<=10)
    {
    echo 'THERE ARE NOT SUFFICIENT DATA TO GENERATE A CHART';
    }
else{
    require_once 'layout/charts.html';
    require_once 'scripts/php/charts_script.php';
    }
echo '
    <br>
    <br>
    <a style="text-align: center;" href="scripts/php/login/logout.php">
        <h4>LOGOUT</h4>
    </a>
    ';

require_once 'layout/footer.html';