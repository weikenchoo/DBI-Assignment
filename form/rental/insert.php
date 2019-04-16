<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
    $conn = connect();
	$response = "";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$rental_date = isset($_POST['rental_date'])?$_POST['rental_date']:""; 
		$inventory_id = isset($_POST['inventory_id'])?$_POST['inventory_id']:"";
		$customer_id = isset($_POST['customer_id'])?$_POST['customer_id']:"";
		$return_date = isset($_POST['return_date'])?$_POST['return_date']:"";
		$staff_id = isset($_POST['staff_id'])?$_POST['staff_id']:"";
		$sql = "INSERT INTO rental(rental_date,inventory_id,customer_id,return_date,staff_id) 
					VALUES('$rental_date','$inventory_id','$customer_id','$return_date','$staff_id')";
					
	if($inventory_id != 'NULL' && $customer_id != 'NULL' && $staff_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
		if($result === TRUE){
			$_SESSION['check'] = 1;
			header('location:../../table/dy_table.php?table_name=rental');
		}

			else
				$response = "Insert failed.";
		}
	
	else if($inventory_id == 'NULL' && $customer_id != 'NULL' && $staff_id != 'NULL'){
		$response = "No available inventory.";
	}

	else if($inventory_id != 'NULL' && $customer_id == 'NULL' && $staff_id != 'NULL'){
		$response = "No available customer.";
	}
	
	else if($inventory_id != 'NULL' && $customer_id != 'NULL' && $staff_id == 'NULL'){
		$response = "No available staff.";
	}
	
	else if($inventory_id == 'NULL' && $customer_id == 'NULL' && $staff_id != 'NULL'){
		$response = "No available inventory and customer.";
	}
	
	else if($inventory_id == 'NULL' && $customer_id != 'NULL' && $staff_id == 'NULL'){
		$response = "No available inventory and staff.";
	}
	
	else if($inventory_id != 'NULL' && $customer_id == 'NULL' && $staff_id == 'NULL'){
		$response = "No available customer and staff.";
	}
	
	else if($inventory_id == 'NULL' && $customer_id == 'NULL' && $staff_id == 'NULL'){
		$response = "No available inventory, customer and staff.";
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
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="main.js"></script>
</head>

<body>
<header>
<nav class="navbar navbar-dark bg-dark">
    <div class="d-flex justify-content-start">
        <div class="row">
        <button type="button" id="sidebarCollapse" class="btn" style="margin-left:20px">  
            <i class="fas fa-align-left"></i>
        </button>
        <a class="col-sm-3 navbar-brand" style="color:white;margin-left:10px" href="../../index.php">SAKILA</a>
        </div>
    </div>
    <div class="navbar nav-item" >
        <a class="nav-link" href="insert.php">Insert</a>
        <a class="nav-link" href="../../table/dy_table.php?table_name=rental">Update</a>
        <a class="nav-link" href="../../table/dy_table.php?table_name=rental">Delete</a>
    </div>
</nav>
</header>

<div class="d-flex" id="wrapper">
<nav id="sidebar">
    <!-- Sidebar -->
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
</nav>
    <!-- /#sidebar-wrapper -->
    

    <!-- Page Content -->
    <div class="page-content-wrapper container" id ="database-table">
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Rental</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
                <div class="form-row">
                    <div class="col">
                        <label for="inventory_id">Inventory ID</label>
						<?php
                            echo "<select type='number' name='inventory_id' id='inventory_id' class='form-control form-control-sm rounded-0'>";
							$sql2 = "SELECT inventory_id FROM inventory ORDER BY inventory_id";
							$inventory_search = mysqli_query($conn,$sql2);
							if(mysqli_num_rows($inventory_search) > 0){
								while($row = mysqli_fetch_assoc($inventory_search)){
									echo "<option value='" . $row['inventory_id'] . "'>" . $row['inventory_id'] . "</option>";
								}
							}
							else{
                                echo "<option value='NULL'>--NULL--</option>";
							}
                            echo "</select>";
						?>
                    </div>
                    <div class="col">
                        <label for="customer_id">Customer ID</label>
						<?php
                            echo "<select type='number' name='customer_id' id='customer_id' class='form-control form-control-sm rounded-0'>";
							$sql3 = "SELECT customer_id FROM customer ORDER BY customer_id";
							$customer_search = mysqli_query($conn,$sql3);
							if(mysqli_num_rows($customer_search) > 0){
								while($row = mysqli_fetch_assoc($customer_search)){
									echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_id'] . "</option>";
								}
							}
							else{
                                echo "<option value='NULL'>--NULL--</option>";
							}
                            echo "</select>";
						?>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="rental_date">Rental Date</label>
                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="rental_date" id="rental_date" required="" placeholder="For example:2014-01-02T11:42:13.510">
                    </div>
                    <div class="col">
                        <label for="return_date">Return Date</label>
                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="return_date" id="return_date" required="" placeholder="For example:2014-01-02T11:42:13.510">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="staff_id">Staff ID</label>
					<?php
                        echo "<select type='number' name='staff_id' id='staff_id' class='form-control form-control-sm rounded-0'>";
							$sql4 = "SELECT staff_id FROM staff ORDER BY staff_id";
							$staff_search = mysqli_query($conn,$sql4);
							if(mysqli_num_rows($staff_search) > 0){
								while($row = mysqli_fetch_assoc($staff_search)){
									echo "<option value='" . $row['staff_id'] . "'>" . $row['staff_id'] . "</option>";
								}
							}
							else{
                                echo "<option value='NULL'>--NULL--</option>";
							}
                            echo "</select>";
						?>
                </div>
                <button type="submit" class="btn btn-outline-dark " >Insert</button>
            </form>
        </div>
      
    <p class="lead container" style="padding-left:20px">  <?php echo $response; $response=""; ?> </p>
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>
</html>

<?php


mysqli_close($conn);
//close connection

?>