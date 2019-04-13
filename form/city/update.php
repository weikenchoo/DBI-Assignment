<?php
    include "../../includes/database.php";
    session_start();
    $conn = connect();
    
    $response ="";

    if(!isset($_SESSION['login_user'])){
      header('Location: ../../loginpage.php');
    }
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }

    if(isset($_GET["id"])) {
        $_SESSION['id'] = $_GET["id"];
        $id = $_SESSION['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $check_query = "SELECT * FROM city WHERE city_id = ".$id;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        

        $city = !empty($_POST['city'])?$_POST['city']:$fetch[0]['city'];
        $country_id = !empty($_POST['country_id'])?$_POST['country_id']:$fetch[0]['country_id'];

        $update_query = "UPDATE city SET city='".$city."', country_id=".$country_id." 
                            WHERE city_id = ".$id;


        if($country_id != 'NULL'){
            $result = mysqli_query($conn, $update_query);
			      if($result) {
                $response = "Database updated successfully.";
                unset($_SESSION['id']);
                header('Location: ../../table/dy_table.php?table_name=city');
            } else {
                $response = "Insert failed.";
            }
        } else {
			$response = "No available countries.";
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
    <a class="nav-link" href="../../table/dy_table.php?table_name=city">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=city">Delete</a>
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

    <?php 
        $check_query2 = "SELECT city, country_id FROM city WHERE city_id =".$id;
        $original_data = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);    
    ?>

    <div class="page-content-wrapper container" id ="database-table">
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">City</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="city" id="city" required="" value = "<?php echo $original_data[0]['city']; ?>">
                </div>
                <div class="form-group">
                  <label for="country_id">Country ID</label>
                    <?php
                    $options_query = "SELECT country_id, country FROM country ORDER BY country";
                    $country_search = mysqli_query($conn, $options_query);
            
                              echo "<select id='country' class='form-control' size='0' name='country_id'>";
                              if(mysqli_num_rows($country_search) > 0){
                                  while($row = mysqli_fetch_assoc($country_search)) {
                                      if($row['country_id'] == $original_data[0]['country_id']) {
                                          echo "<option value='" . $row['country_id'] . "' selected>" . $row['country'] . "</option>";
                                      } else {
                                          echo "<option value='" . $row['country_id'] . "'>" . $row['country'] . "</option>";
                                      }                                    
                                  }
                              }
                              else 
                                  echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                                      echo "</select>";
                      ?>
                </div>
                
                <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=city'" >  
                <input type="submit" class="btn btn-outline-dark" value="Save Changes">
            </form>
        </div>
      
    
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
</body>
</html>

<?php 
  mysqli_close($conn);
?>