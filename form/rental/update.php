<?php
    include "../../includes/database.php";
    include "../../includes/check_login.php";
    $conn = connect();
    
    $response = "";

    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }

    if(isset($_GET["id"])) {
        $_SESSION['id'] = $_GET["id"];
        $id = $_SESSION['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $check_query = "SELECT * FROM rental WHERE rental_id =".$id;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        
        
        $inventory_id = !empty($_POST['inventory_id'])?$_POST['inventory_id']:$fetch[0]['inventory_id'];       
        $customer_id = !empty($_POST['customer_id'])?$_POST['customer_id']:$fetch[0]['customer_id'];
        $rental_date = !empty($_POST['rental_date'])?$_POST['rental_date']:$fetch[0]['rental_date'];
        $return_date = !empty($_POST['return_date'])?$_POST['return_date']:$fetch[0]['return_date'];
        $staff_id = !empty($_POST['staff_id'])?$_POST['staff_id']:$fetch[0]['staff_id'];    

        $dateTimeStampRental = strtotime($rental_date);
        $dateTimeStampReturn = strtotime($return_date);

        $update_query = "UPDATE rental SET inventory_id = ".$inventory_id.", customer_id=".$customer_id.", rental_date='".$rental_date."', return_date ='".$return_date."', staff_id=".$staff_id."
                            WHERE rental_id =".$id;

        if ($dateTimeStampRental < $dateTimeStampReturn) {
            if($staff_id != 'NULL' && $customer_id != 'NULL' && $inventory_id != 'NULL'){
                $result = mysqli_query($conn, $update_query);

                if($result) {
                    $response = "Database updated successfully.";
                    unset($_SESSION['id']);
                    header('Location: ../../table/dy_table.php?table_name=rental');
                } else {
                    $response = "Insert failed.";
                }
            } else {
                $response = "No available inventory, customer or staff";
            }            
        } else {
            $response = "Return date must be after rental date!";
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
    <a class="nav-link" href="../../table/dy_table.php?table_name=rental">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=rental">Delete</a>
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
    
    <?php 
        $check_query2 = "SELECT * FROM rental WHERE rental_id =".$id;
        $original_data = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);
    ?>

    <!-- Page Content -->
    <div class="page-content-wrapper container" id ="database-table">
    <div class="card">
        <div class="card-header">
        <!-- this is for table -->
            <h4 class="mb-0">Rental</h4>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" method = "POST">
            <div class="form-row">
                    <div class="col">
                        <label for="inventory_id">Inventory ID</label>
                        <?php
                            $options_query = "SELECT inventory_id FROM inventory";
                            $inventory_search = mysqli_query($conn, $options_query);                            
        
                            echo "<select id='inventory' class='form-control form-control-sm rounded-0' name='inventory_id'>";
                            if(mysqli_num_rows($inventory_search) > 0){
                                while($row = mysqli_fetch_assoc($inventory_search)) {
                                if($row['inventory_id'] == $original_data[0]['inventory_id']) {
                                    echo "<option value='" . $row['inventory_id'] . "' selected>" . $row['inventory_id'] . "</option>";
                                } else {
                                    echo "<option value='" . $row['inventory_id'] . "'>" . $row['inventory_id']  . "</option>";                                                                  
                                    }
                                }
                            }
                            else 
                                echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                                    echo "</select>";
                        ?>
                    </div>
                    <div class="col">
                        <label for="customer_id">Customer ID</label>
                        <?php
                            $options_query2 = "SELECT customer_id, first_name, last_name FROM customer";
                            $customer_search = mysqli_query($conn, $options_query2);                            
        
                            echo "<select id='customer' class='form-control form-control-sm rounded-0' name='customer_id'>";
                            if(mysqli_num_rows($customer_search) > 0){
                                while($row = mysqli_fetch_assoc($customer_search)) {
                                if($row['customer_id'] == $original_data[0]['customer_id']) {
                                    echo "<option value='" . $row['customer_id'] . "' selected>" . $row['customer_id'] . ". " . $row['first_name'] . " " . $row['last_name']  . "</option>";
                                } else {
                                    echo "<option value='" . $row['customer_id'] . "'>" . $row['customer_id']  . ". " . $row['first_name'] . " " . $row['last_name']  . "</option>";                                                                  
                                    }
                                }
                            }
                            else 
                                echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                                    echo "</select>";
                        ?>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="rental_date">Rental Date</label>
                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="rental_date" id="rental_date" required="" placeholder="For example:2014-01-02T11:42:13.510" 
                            value = '<?php echo $original_data[0]["rental_date"] ?>'>
                    </div>
                    <div class="col">
                        <label for="return_date">Return Date</label>
                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="return_date" id="return_date" required="" placeholder="For example:2014-01-02T11:42:13.510"
                        value = '<?php echo $original_data[0]["return_date"] ?>'>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="staff_id">Staff ID</label>
                        <?php
                            $options_query3 = "SELECT staff_id, first_name, last_name FROM staff";
                            $staff_search = mysqli_query($conn, $options_query3);                            
        
                            echo "<select id='staff' class='form-control form-control-sm rounded-0' name='staff_id'>";
                            if(mysqli_num_rows($staff_search) > 0){
                                while($row = mysqli_fetch_assoc($staff_search)) {
                                if($row['staff_id'] == $original_data[0]['staff_id']) {
                                    echo "<option value='" . $row['staff_id'] . "' selected>" . $row['staff_id'] . ". " . $row['first_name'] . " " . $row['last_name']  . "</option>";
                                } else {
                                    echo "<option value='" . $row['staff_id'] . "'>" . $row['staff_id']  . ". " . $row['first_name'] . " " . $row['last_name']  . "</option>";                                                                  
                                    }
                                }
                            }
                            else 
                                echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                                    echo "</select>";
                        ?>
                        </div>
                <div class="form-row">
                    <div class="col-lg-9">
                    <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=rental'" >
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

<?php 
mysqli_close($conn);
?>