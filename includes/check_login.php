<?php //this file is to be included in each insert,update and delete files for each table
ini_set('session.gc_maxlifetime', 300);

// each client should remember their session id for EXACTLY 5 minutes
session_set_cookie_params(300);

session_start();

if(!isset($_SESSION['login_user'])){
	header('Location: ../../loginpage.php');
}

?>