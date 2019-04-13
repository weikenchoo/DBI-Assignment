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

        $check_query = "SELECT * FROM store WHERE store_id = ".$id;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        

        $manager_staff_id = !empty($_POST['manager_staff_id'])?$_POST['manager_staff_id']:$fetch[0]['manager_staff_id'];
        $address_id = !empty($_POST['address_id'])?$_POST['address_id']:$fetch[0]['address_id'];

        $update_query = "UPDATE store SET manager_staff_id=".$manager_staff_id.", address_id=".$address_id." 
                            WHERE store_id = ".$id;

        if($address_id != 'NULL'){
            $result = mysqli_query($conn, $update_query);

            if($result) {
                $response = "Database updated successfully.";
                unset($_SESSION['id']);
                header('Location: ../../table/dy_table.php?table_name=store');
            } else {
                $response = "Insert failed.";
            }
        } else {
            $response = "No available addresses.";
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
    <a class="nav-link" href="../../table/dy_table.php?table_name=store">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=store">Delete</a>
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
        $check_query2 = "SELECT store.*, address.address FROM store INNER JOIN address ON store.address_id = address.address_id WHERE store_id =".$id;
        $original_data = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);
    ?>
    

    <!-- Page Content -->
    <div class="page-content-wrapper container" id ="database-table">
    <div class="card">
        <div class="card-header">
        <!-- this is for table -->
            <h3 class="mb-0">Store</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" method = "POST">
            <div class="form-group">
                <label for="manager_staff_id">Manager Staff ID</label>
                <input type="text" class="form-control form-control-lg rounded-0" name="manager_staff_id" id="ID" required="" value = "<?php echo $original_data[0]['manager_staff_id'] ?>">
            </div>
                <div class="form-group">
                    <label for="addres_id">Address ID</label>
                    <?php
                        // query all address that are not used by customer, store, and staff
                        $options_query = "SELECT a.address_id, a.address FROM address a
                                            WHERE NOT EXISTS(SELECT c.address_id FROM customer c WHERE a.address_id = c.address_id) AND 
                                            NOT EXISTS(SELECT s.address_id FROM store s WHERE a.address_id = s.address_id) AND 
                                            NOT EXISTS(SELECT s2.address_id FROM staff s2 WHERE a.address_id = s2.address_id)
                                            ORDER BY a.address";
                        $address_search = mysqli_query($conn, $options_query);    

                        echo "<select id='address' class= 'form-control form-control-lg rounded-0' name='address_id'>";
                        echo "<option value='" . $original_data[0]['address_id'] . "' selected>(" . $original_data[0]['address_id'] . "). " . $original_data[0]['address'] . "</option>";
                        if(mysqli_num_rows($address_search) > 0){
                            while($row = mysqli_fetch_assoc($address_search)) {
                                echo "<option value='" . $row['address_id'] . "'>(" . $row['address_id'] . "). "  .$row['address']. "</option>";                                                   
                            }
                        }
                        else 
                            echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                                echo "</select>";
                ?>
                </div>

            <div class="form-row">
                <div class="col-lg-9">
                    <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=store'" >
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