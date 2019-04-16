<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
	
    $conn = connect();
    $response = "";

    if(!isset($_SESSION['login_user'])){
      header('Location: ../loginpage.php');
    }

    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$address = isset($_POST['address'])?$_POST['address']:""; 
		$address2 = isset($_POST['address2'])?$_POST['address2']:"";
		$district = isset($_POST['district'])?$_POST['district']:"";
		$city_id = isset($_POST['city_id'])?$_POST['city_id']:"";
		$postcode = isset($_POST['postcode'])?$_POST['postcode']:"";
		$phone = isset($_POST['phone'])?$_POST['phone']:"";
		
		$sql = "INSERT INTO address(address,address2,district,city_id,postal_code,phone) 
					VALUES('$address','$address2','$district','$city_id','$postcode','$phone')";
					
		if($city_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
			if($result === TRUE){
				$_SESSION['check'] = 1;
				header('location:../../table/dy_table.php?table_name=address');
			}
			else
				$response = "Insert failed.";
		}
			
		else{
			$response = "No available city.";
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
        <a class="nav-link" href="../../table/dy_table.php?table_name=address">Update</a>
        <a class="nav-link" href="../../table/dy_table.php?table_name=address">Delete</a>
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
            <h3 class="mb-0">Address</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
                <!-- <div class="form-group row">
                    <label  class="col-lg-3 col-form-label form-control-label">Address</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="address" id="address" required="">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div> -->

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Address</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="address" id="address" required="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Address 2</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="address2" id="address2" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">District</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="district" id="district" >
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">City</label>
                    <div class="col-lg-9">
					<?php
					$sql2 = "SELECT city, city_id FROM city ORDER BY city";
					$city_search = mysqli_query($conn, $sql2);
					
                      echo "<select id='city' class='form-control' size='0' name='city_id'>";
					  if(mysqli_num_rows($city_search) > 0){
						  while($row = mysqli_fetch_assoc($city_search)) {
							echo "<option value='" . $row['city_id'] . "'>" . $row['city'] . "</option>";
						  }
					  }
					  else 
						echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
							echo "</select>";
					?>                   
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Postal Code</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="number" name="postcode" id="postcode" >
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="number" name="phone" id="phone" >
                        
                    </div>
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