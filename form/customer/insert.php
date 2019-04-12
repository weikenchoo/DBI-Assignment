<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
    $conn = connect();
	$response = "";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$store_id = isset($_POST['district'])?$_POST['district']:"";
		$f_name = strtoupper(isset($_POST['first_name'])?$_POST['first_name']:""); 
		$l_name = strtoupper(isset($_POST['last_name'])?$_POST['last_name']:"");
		$email = isset($_POST['email'])?$_POST['email']:"";
		$address_id = isset($_POST['address_id'])?$_POST['address_id']:"";
		$active = isset($_POST['active'])?$_POST['active']:"";
		
		$sql = "INSERT INTO customer(store_id,first_name,last_name,email,addres_id,active,create_date) 
					VALUES('$store_id','$f_name','$l_name','$email','$address_id','$active',CURRENT_TIMESTAMP)";
					
		if($address_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
			if($result === TRUE)
				$response = "Database updated successfully.";
			else
				$response = "Insert failed.";
		}
			
		else{
			$response = "No available address.";
		}

}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Interface for SAKILA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="main.js"></script>
</head>

<body>
<header>
<nav class="navbar navbar-dark bg-dark">
  <div class="navbar-header mr-auto">
    <a class="navbar-brand" href = "../../index.php">SAKILA</a>
  </div>
  <div class="navbar nav-item" >
    <a class="nav-link" href="insert.php">Insert</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=customer">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=customer">Delete</a>
  </div>
</nav>
</header>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      
      <div class="list-group list-group-flush">
        <a href="../../table/dy_table.php?table_name=actor" class="list-group-item list-group-item-action bg-light">Actor</a>
        <a href="../../table/dy_table.php?table_name=address" class="list-group-item list-group-item-action bg-light">Address</a>
        <a href="../../table/dy_table.php?table_name=category" class="list-group-item list-group-item-action bg-light">Category</a>
        <a href="../../table/dy_table.php?table_name=city" class="list-group-item list-group-item-action bg-light">City</a> 
        <a href="../../table/dy_table.php?table_name=country" class="list-group-item list-group-item-action bg-light">Country</a>
        <a href="../../table/dy_table.php?table_name=customer" class="list-group-item list-group-item-action bg-light">Customer</a>
        <a href="../../table/dy_table.php?table_name=film" class="list-group-item list-group-item-action bg-light">Film</a>
        <a href="../../table/dy_table.php?table_name=film_actor" class="list-group-item list-group-item-action bg-light">Film & Actor</a>
        <a href="../../table/dy_table.php?table_name=film_category" class="list-group-item list-group-item-action bg-light">Film Category</a>
        <a href="../../table/dy_table.php?table_name=film_text" class="list-group-item list-group-item-action bg-light">Film Text</a>
        <a href="../../table/dy_table.php?table_name=inventory" class="list-group-item list-group-item-action bg-light">Inventory</a>
        <a href="../../table/dy_table.php?table_name=language" class="list-group-item list-group-item-action bg-light">Language</a>
        <a href="../../table/dy_table.php?table_name=payment" class="list-group-item list-group-item-action bg-light">Payment</a>
        <a href="../../table/dy_table.php?table_name=rental" class="list-group-item list-group-item-action bg-light">Rental</a>
        <a href="../../table/dy_table.php?table_name=staff" class="list-group-item list-group-item-action bg-light">Staff</a>
        <a href="../../table/dy_table.php?table_name=store" class="list-group-item list-group-item-action bg-light">Store</a> 
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    

    <!-- Page Content -->
    <div class="page-content-wrapper container" id ="database-table">
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Customer</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control form-control-sm rounded-0" name="first_name" id="first_name" required="">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control form-control-sm rounded-0" name ="last_name" id="last_name" required="" >
                    <div class="invalid-feedback" style="color:black;" >Enter your password too!</div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="store_id">Store ID</label>
                      <select class="form-control form-control-sm" name="store_id" id="store_id">
                        <option value="">1</option>
                        <option value="">2</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label fo="addres_id">Address ID</label>
                      <select class="form-control form-control-sm" name="address_id" id="address_id">
                        <option value="">1</option>
                        <option value="">2</option>
                      </select>
                    </div>
                  </div>
                  
                </div>
                <label for="active">Active</label>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="active" id="active">
                    <label class="form-check-label" for="active">Yes</label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" value="0" name="active" id="active">
                      <label class="form-check-label" for="active">No</label>
                  </div>
                </div>
                  
                
                
                <button type="submit" class="btn btn-outline-dark " >Insert</button>
            </form>
        </div>
      
    
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
</body>
</html>