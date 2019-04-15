<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
    $conn = connect();
	$response = "";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$film_id = isset($_POST['film_id'])?$_POST['film_id']:""; 
		$store_id = isset($_POST['store_id'])?$_POST['store_id']:"";
		
		$sql = "INSERT INTO inventory(film_id,store_id) 
					VALUES('$film_id','$store_id')";
		
	if($store_id != 'NULL' && $film_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
		if($result === TRUE){
			$_SESSION['check'] = 1;
			header('location:../../table/dy_table.php?table_name=inventory');
		}

			else
				$response = "Insert failed.";
		}
	
	else if($film_id == 'NULL' && $store_id != 'NULL'){
		$response = "No available film.";
	}

	else if($store_id == 'NULL' && $film_id != 'NULL'){
		$response = "No available store.";
	}
	
	else if($store_id == 'NULL' && $film_id == 'NULL'){
		$response = "No available store and film.";
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
    <a class="nav-link" href="../../table/dy_table.php?table_name=inventory">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=inventory">Delete</a>
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
            <h3 class="mb-0">Inventory</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
            <div class="form-row">
                    <div class="col">
                        <label for="film_id">Film</label>
						<?php
                            echo "<select type='number' name='film_id' id='film_id' class='form-control rounded-0'>";
							$sql2 = "SELECT film_id, title FROM film ORDER BY title";
							$film_search = mysqli_query($conn, $sql2);
							if(mysqli_num_rows($film_search) > 0){
								while($row = mysqli_fetch_assoc($film_search)){
									echo "<option value='" . $row['film_id'] . "'>" . $row['title'] . "</option>";
                                }
							}
							else{
								echo "<option value='NULL'> --NULL-- </option>";
							}
                            echo "</select>";
						?>
                    </div>
                    <div class="col">
                        <label for="Store_id">Store ID</label>
						<?php
                            echo "<select type='number' name='store_id' id='Store_id' class='form-control rounded-0'>";
							$sql3 = "SELECT store_id FROM store ORDER BY store_id";
							$store_search = mysqli_query($conn, $sql3);
							if(mysqli_num_rows($store_search) > 0){
								while($row = mysqli_fetch_assoc($store_search)){
									echo "<option value='" . $row['store_id'] . "'>" . $row['store_id'] . "</option>";
                                }
							}
							else{
								echo "<option value='NULL'> --NULL-- </option>";
							}
                            echo "</select>";
						?>
                            
                    </div>
                </div>
                <br>
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