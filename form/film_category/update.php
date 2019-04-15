<?php
    include "../../includes/database.php";
    include "../../includes/check_login.php";
    $conn = connect();
    
    $response = "";

    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }

    if(isset($_GET["id1"])) {
        $_SESSION['id1'] = $_GET["id1"];
        $_SESSION['id2'] = $_GET['id2'];
        $id1 = $_SESSION['id1'];
        $id2 = $_SESSION['id2'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $check_query = "SELECT * FROM film_category WHERE film_id =".$id1." AND category_id=".$id2;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        
        
        $film_id = !empty($_POST['film_id'])?$_POST['film_id']:$fetch[0]['film_id'];       
        $category_id = !empty($_POST['category_id'])?$_POST['category_id']:$fetch[0]['category_id'];

        $update_query = "UPDATE film_category SET film_id = ".$film_id.", category_id=".$category_id."
                            WHERE film_id =".$id1." AND category_id=".$id2;

        if($category_id != 'NULL' || $film_id != 'NULL'){
            $result = mysqli_query($conn, $update_query);

            if($result) {
                unset($_SESSION['id1']);
                unset($_SESSION['id2']);
				$_SESSION['update_check'] = 1;
                header('Location: ../../table/dy_table.php?table_name=film_category');
            } else {
                $response = "Insert failed.";
            }
        } else {
            $response = "No available films or categories.";
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
    <a class="nav-link" href="../../table/dy_table.php?table_name=film_category">Update</a>
    <a class="nav-link" href="../../table/dy_table.php?table_name=film_category">Delete</a>
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
        $check_query2 = "SELECT film_category.*, film.title FROM film_category INNER JOIN film ON film_category.film_id = film.film_id WHERE film_category.film_id =".$id1." AND  film_category.category_id=".$id2 ; 
        $original_data = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);
    ?>


    <!-- Page Content -->
    <div class="page-content-wrapper container" id ="database-table">
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Film category</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
            <div class="form-group">
              <label for="film_id">Film ID</label>
                <?php
                    $options_query = "SELECT f.film_id, f.title FROM film f
                                      WHERE NOT EXISTS(SELECT fc.film_id FROM film_category fc WHERE f.film_id = fc.film_id)";                    
                    $film_search = mysqli_query($conn, $options_query);                            
  
                    echo "<select id='film' class='form-control form-control-lg' name='film_id' disabled>";
                    echo "<option value='" . $original_data[0]['film_id'] . "' selected>" . $original_data[0]['film_id'] . ". " . $original_data[0]['title'] . "</option>";
                    echo "</select>";
                ?>
            </div>
            <div class="form-group">
              <label for="category_id">Category ID</label>
                <?php
                    $options_query2 = "SELECT category_id, name FROM category";
                    $category_search = mysqli_query($conn, $options_query2);                            
  
                    echo "<select id='category' class='form-control form-control-lg' name='category_id'>";
                    if(mysqli_num_rows($category_search) > 0){
                        while($row = mysqli_fetch_assoc($category_search)) {
                          if($row['category_id'] == $original_data[0]['category_id']) {
                              echo "<option value='" . $row['category_id'] . "' selected>" . $row['category_id'] . ". " . $row['name']. "</option>";
                          } else {
                              echo "<option value='" . $row['category_id'] . "'>" . $row['category_id']  . ". " . $row['name']. "</option>";                                                                  
                          }
                        }
                    }
                    else 
                        echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                            echo "</select>";
                ?>
            </div>
            <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=film_category'" >  
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