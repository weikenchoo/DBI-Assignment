<?php

session_start();
include "./includes/database.php";
$conn = connect();
$error = "";

if(isset($_POST['login'])){
	
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "select username, password from staff where username = '$username' AND password = '$password'";
		
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) == 0){
			$error = "*Invalid username or password";					
		}
		
		else {
			$_SESSION['login_user'] = $username;
			header("location: index.php");
			
		}
		
	}

if(isset($_SESSION['login_user'])){
	header("location: index.php");
	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
    .heading{
        text-align: center;
        margin-top: 75px;
        font-weight: 600
    }
	.login-form {
		width: 340px;
    	margin: 75px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<h1 class ="heading">SAKILA Database</h1>
<div class="login-form">
    <form action = "" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required" name = "username">
        </div>  
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name = "password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark btn-block" name = "login">Log in</button>
        </div>    <br>  
		<span style="color:red"> <?php echo $error?> </span>
    </form>
</div>
</body>
</html>

<?php


mysqli_close($conn);
//close connection

?>