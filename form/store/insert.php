<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";	
    $conn = connect();
	$response = "";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$manager_id = isset($_POST['manager_staff_id'])?$_POST['manager_staff_id']:""; 
		$address_id = isset($_POST['address_id'])?$_POST['address_id']:"";
		
		$sql = "INSERT INTO store(manager_staff_id,address_id) 
					VALUES('$manager_id','$address_id')";
			
		if($address_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
			if($result === TRUE){
				$_SESSION['check'] = 1;
				header('location:../../table/dy_table.php?table_name=store');
			}
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
        <a class="col-sm-3 navbar-brand" style="color:white;margin-left:10px" href="../index.php">SAKILA</a>
        </div>
    </div>
    <div class="navbar nav-item" >
        <a class="nav-link" href="insert.php">Insert</a>
        <a class="nav-link" href="../../table/dy_table.php?table_name=store">Update</a>
        <a class="nav-link" href="../../table/dy_table.php?table_name=store">Delete</a>
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
            <h3 class="mb-0">Store</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert" method="POST">
            <div class="form-group">
                    <label for="manager_staff_id">Manager Staff ID</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="manager_staff_id" id="ID" required="">
                </div>
                <div class="form-group">
                    <label for="address_id">Address ID</label>
					<?php
                    echo "<select type='text' class='form-control form-control-lg rounded-0' name='address_id' id='ID'>";
					//return addresses which does not exist in customer,store and staff tables
					$sql2 = "SELECT a.address_id, a.address FROM address a 
							WHERE NOT EXISTS(SELECT c.address_id FROM customer c WHERE a.address_id = c.address_id) AND 
							NOT EXISTS(SELECT s.address_id FROM store s WHERE a.address_id = s.address_id) AND 
							NOT EXISTS(SELECT s2.address_id FROM staff s2 WHERE a.address_id = s2.address_id)
							ORDER BY a.address";
					$address_search = mysqli_query($conn,$sql2);
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