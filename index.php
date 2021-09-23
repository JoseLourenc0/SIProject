<?php

session_start();

$_SESSION['fa'] = $_SESSION['fa'] ?? true;
$_SESSION['logged'] = $_SESSION['logged'] ?? false;

require_once 'layout/header.html';

if($_SESSION['logged']){

    require_once 'layout/index.html';

}else{
    require_once 'layout/login.html';
    if(!$_SESSION['logged'] && !$_SESSION['fa'])
        require_once 'layout/modalCredentials.html';
}

require_once 'layout/footer.html';