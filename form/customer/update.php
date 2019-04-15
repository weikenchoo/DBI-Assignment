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

        $check_query = "SELECT * FROM customer WHERE customer_id = ".$id;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        

        $f_name = !empty($_POST['first_name'])?$_POST['first_name']:$fetch[0]['first_name'];
        $l_name = !empty($_POST['last_name'])?$_POST['last_name']:$fetch[0]['last_name'];
        $email = !empty($_POST['email'])?$_POST['email']:$fetch[0]['email'];
        $address_id = !empty($_POST['address_id'])?$_POST['address_id']:$fetch[0]['address_id'];
        $store_id = !isset($_POST['store_id'])?$_POST['store_id']:$fetch[0]['store_id'];
        
        // isset() and empty() sees 0 as empty/not set where 0 can be the value for $_POST['active], therefore I removed the validation
        $active = $_POST['active'];

        $update_query = "UPDATE customer SET first_name='".strtoupper($f_name)."', last_name='".strtoupper($l_name)."', email='".$email."', 
                          address_id=".$address_id.", active=".$active."
                            WHERE customer_id = ".$id;

        if($address_id != 'NULL' || $store_id != 'NULL'){
            $result = mysqli_query($conn, $update_query);

            if($result) {
                $response = "Database updated successfully.";
                unset($_SESSION['id']);
                header('Location: ../../table/dy_table.php?table_name=customer');
            } else {
                $response = "Insert failed.";
            }
        } else {
            $response = "No available addresses or stores.";
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

    <?php 
        $check_query2 = "SELECT customer.*, address.address FROM customer INNER JOIN address ON customer.address_id = address.address_id WHERE customer.customer_id =".$id;
        $original_data = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);
    ?>
    

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
                    <input type="text" class="form-control form-control-sm rounded-0" name="first_name" id="first_name" required="" value = "<?php echo $original_data[0]['first_name']; ?>">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control form-control-sm rounded-0" name ="last_name" id="last_name" required="" value = "<?php echo $original_data[0]['last_name']; ?>">
                    <div class="invalid-feedback" style="color:black;" >Enter your password too!</div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control form-control-sm rounded-0" name ="email" id="email" required="" value = "<?php echo $original_data[0]['email']; ?>">
                    <div class="invalid-feedback" style="color:black;" >Enter your password too!</div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="store_id">Store ID</label>
                        <?php
                            $options_query = "SELECT store_id FROM store";
					                  $store_search = mysqli_query($conn, $options_query);
					
                            echo "<select id='store' class='form-control form-control-sm' name='store_id'>";
                            if(mysqli_num_rows($store_search) > 0){
                                while($row = mysqli_fetch_assoc($store_search)) {
                                    if($row['store_id'] == $original_data[0]['store_id']) {
                                        echo "<option value='" . $row['store_id'] . "' selected>" . $row['store_id'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row['store_id'] . "'>" . $row['store_id'] . "</option>";
                                    }                                    
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
                      <label for="addres_id">Address ID</label>
                        <?php
                            // query all address that are not used by customer, store, and staff
                            $options_query2 = "SELECT a.address_id, a.address FROM address a
                                                WHERE NOT EXISTS(SELECT c.address_id FROM customer c WHERE a.address_id = c.address_id) AND 
                                                NOT EXISTS(SELECT s.address_id FROM store s WHERE a.address_id = s.address_id) AND 
                                                NOT EXISTS(SELECT s2.address_id FROM staff s2 WHERE a.address_id = s2.address_id)
                                                ORDER BY a.address";
                            $address_search = mysqli_query($conn, $options_query2);      

                            echo "<select id='address' class= 'form-control form-control-sm' name='address_id'>";
                            echo "<option value='" . $original_data[0]['address_id'] . "' selected>(" . $original_data[0]['address_id'] . "). " . $original_data[0]['address'] . "</option>";
                            if(mysqli_num_rows($address_search) > 0){
                                while($row = mysqli_fetch_assoc($address_search)) {
                                  echo "<option value='" . $row['address_id'] . "' >(" . $row['address_id'] . "). " . $row['address'] . "</option>";
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
                  <?php 
                    if($original_data[0]['active'] == 1) {
                      echo '<input class="form-check-input" type="radio" value="1" name="active" id="active" checked="checked">';
                    } else {
                      echo '<input class="form-check-input" type="radio" value="1" name="active" id="active">';
                    }
                    echo '<label class="form-check-label" for="active" >Yes</label>';
                  ?>
                
                  </div>
                  <div class="form-check">
                      <?php 
                      if($original_data[0]['active'] == 0) {
                          echo '<input class="form-check-input" type="radio" value="0" name="active" id="not_active" checked="checked">';
                        } else {
                          echo '<input class="form-check-input" type="radio" value="0" name="active" id="not_active">';
                      }
                      echo '<label class="form-check-label" for="not_active" >No</label>';
                      ?>
                  </div>
                </div>
                <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=customer'" >  
                <input type="submit" class="btn btn-outline-dark" value="Save Changes"> 
                
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
?>