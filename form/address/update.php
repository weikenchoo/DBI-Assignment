<?php
    include "../../includes/database.php";
    include "../../includes/check_login.php";
    $conn = connect();

    $response ="";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }

    if(isset($_GET["id"])) {
        $_SESSION['id'] = $_GET["id"];
        $id = $_SESSION['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $check_query = "SELECT * FROM address WHERE address_id = ".$id;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        

        $address = !empty($_POST['address'])?$_POST['address']:$fetch[0]['address'];
        $address2 = !empty($_POST['address2'])?$_POST['address2']:$fetch[0]['address2'];
        $district = !empty($_POST['district'])?$_POST['district']:$fetch[0]['district'];
        $city_id = !empty($_POST['city_id'])?$_POST['city_id']:$fetch[0]['city_id'];
        $postal_code = !empty($_POST['postal_code'])?$_POST['postal_code']:$fetch[0]['postal_code'];
        $phone = !empty($_POST['phone'])?$_POST['phone']:$fetch[0]['phone'];


        $update_query = "UPDATE address SET address='".$address."', address2='".$address2."', district='".$district."', city_id='".$city_id."', postal_code='".$postal_code."',
                        phone='".$phone."' 
                            WHERE address_id = ".$id;

        if($city_id != 'NULL'){
			$result = mysqli_query($conn, $update_query);
			if($result) {
                unset($_SESSION['id']);
				$_SESSION['update_check'] = 1;
                header('Location: ../../table/dy_table.php?table_name=address');
            } else {
                $response = "Insert failed.";
            }
        } else {
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
    <a class="nav-link" href="../../table/dy_table.php?table_name=address">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=address">Delete</a>
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
    <div class="card">
        <div class="card-header">
        <!-- this is for table -->
            <h4 class="mb-0">Address</h4>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" method = "POST">
                <?php 
                    $query = "SELECT * FROM address WHERE address_id =".$id;
                    $result = mysqli_query($conn, $query);
                    $fetch_ori = mysqli_fetch_all($result, MYSQLI_ASSOC);                            
                ?>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Address</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name= "address" value = "<?php echo $fetch_ori[0]['address'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Address 2</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="address2" id="address2" value = "<?php echo $fetch_ori[0]['address2'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">District</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name= "district" value = "<?php echo $fetch_ori[0]['district'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">City</label>
                    <div class="col-lg-9">
                        <?php
                            $check_query2 = "SELECT city_id FROM address WHERE address_id =".$id;
                            $original_city = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);

					        $options_query = "SELECT city, city_id FROM city ORDER BY city";
					        $city_search = mysqli_query($conn, $options_query);
					
                            echo "<select id='city' class='form-control' size='0' name='city_id'>";
                            if(mysqli_num_rows($city_search) > 0){
                                while($row = mysqli_fetch_assoc($city_search)) {
                                    if($row['city_id'] == $original_city[0]['city_id']) {
                                        echo "<option value='" . $row['city_id'] . "' selected>" . $row['city'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row['city_id'] . "'>" . $row['city'] . "</option>";
                                    }                                    
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
                        <input class="form-control" type="number" name="postcode" id="postcode" value = "<?php echo $fetch_ori[0]['postal_code'] ?>">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="number" name="phone" id="phone" value = "<?php echo $fetch_ori[0]['phone'] ?>">
                        
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=address'" >  
                        <input type="submit" class="btn btn-outline-dark" value="Save Changes">
                    </div>
                </div>
            </form>
        </div>
        <p class="lead container" style="padding-left:20px">  <?php echo $response; $response=""; ?> </p>
    </div>
      
    
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
</body>
</html>