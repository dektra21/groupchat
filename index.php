<?php
session_start();
require 'include/Connection.php';

$page = isset($_GET['page']) ? $_GET['page'] : NULL;

if ($page == 'register') {
    require 'register.php';
}
elseif ($page == 'dashboard') {  
    require 'dashboard.php';
}
else {
    require 'login.php';
}

?>
