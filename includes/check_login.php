<?php //this file is to be included in each insert,update and delete files for each table
session_start();

if(!isset($_SESSION['login_user'])){
	header('Location: ../../loginpage.php');
}

?>