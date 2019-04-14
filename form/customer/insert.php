<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
    $conn = connect();
	$response = "";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$store_id = isset($_POST['store_id'])?$_POST['store_id']:"";
		$f_name = strtoupper(isset($_POST['first_name'])?$_POST['first_name']:""); 
		$l_name = strtoupper(isset($_POST['last_name'])?$_POST['last_name']:"");
		$email = isset($_POST['email'])?$_POST['email']:"";
		$address_id = isset($_POST['address_id'])?$_POST['address_id']:"";
		$active = isset($_POST['active'])?$_POST['active']:"";
		$sql = "INSERT INTO customer(store_id,first_name,last_name,email,address_id,active,create_date) 
					VALUES('$store_id','$f_name','$l_name','$email','$address_id',$active,CURRENT_TIMESTAMP)";
					
	if($store_id != 'NULL' && $address_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
			if($result === TRUE)
				$response = "Database updated successfully.";
			else
				$response = "Insert failed.";
		}
	
	else if($address_id == 'NULL' && $store_id != 'NULL'){
		$response = "No available address.";
	}

	else if($store_id == 'NULL' && $address_id != 'NULL'){
		$response = "No available store.";
	}
	
	else if($store_id == 'NULL' && $film_id == 'NULL'){
		$response = "No available store and address.";
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
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control form-control-sm rounded-0" name ="email" id="email" required="" >
                    <div class="invalid-feedback" style="color:black;" >Enter your password too!</div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="store_id">Store ID</label>
					  <?php
                      echo "<select class='form-control form-control-sm' name='store_id' id='store_id'>";
					  $sql2 = "SELECT store_id FROM store ORDER BY store_id";
					  $store_search = mysqli_query($conn,$sql2);
					  if(mysqli_num_rows($store_search) > 0){
						  while($row=mysqli_fetch_assoc($store_search)){
								echo "<option value='" .$row['store_id'] . "'>" .$row['store_id'] . "</option>";
						  }
					  }
					  else
						  echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                      echo "</select>";
					  ?>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label fo="addres_id">Address </label>
					<?php
                    echo "<select class='form-control form-control-sm' name='address_id' id='address_id'>";
					//return addresses which does not exist in customer,store and staff tables
					$sql3 = "SELECT a.address_id, a.address FROM address a 
							WHERE NOT EXISTS(SELECT c.address_id FROM customer c WHERE a.address_id = c.address_id) AND 
							NOT EXISTS(SELECT s.address_id FROM store s WHERE a.address_id = s.address_id) AND 
							NOT EXISTS(SELECT s2.address_id FROM staff s2 WHERE a.address_id = s2.address_id)
							ORDER BY a.address";
					$address_search = mysqli_query($conn,$sql3);
					if(mysqli_num_rows($address_search) > 0){
							while($row = mysqli_fetch_assoc($address_search)){
								echo "<option value='" . $row['address_id'] . "'>" . $row['address'] . "</option>";
							}
					}
					else
						echo "<option value = 'NULL'>" . "--NULL--" . "</option>";     
                    echo "</select>";
					?>
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
      
    <p class="lead container" style="padding-left:20px">  <?php echo $response; $response=""; ?> </p>
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
</body>

</html>

<?php


mysqli_close($conn);
//close connection

?>