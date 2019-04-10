<?php
    include "../includes/database.php";
    $conn = connect();
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Interface for SAKILA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="main.js"></script>
</head>

<body>
<header>
<nav class="navbar navbar-dark bg-dark">
  <div class="navbar-header mr-auto">
    <a class="navbar-brand" href = "../index.php">SAKILA</a>
  </div>
  <div class="navbar nav-item" >
    <!-- Backend will change href to respective tables -->
    <a class="nav-link" href="../form/actor/insert.php">Insert</a>
    <a class="nav-link" href="../form/actor/update.php">Update</a>
    <a class="nav-link" href="#">Delete</a>
  </div>
    
    <button type="button" class="btn btn-default btn-sm">
      <i class="fas fa-sign-out-alt"></i> Log out
    </button>
</nav>
</header>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      
      <div class="list-group list-group-flush">
        <a href="dy_table.php?table_name=actor" class="list-group-item list-group-item-action bg-light">Actor</a>
        <a href="dy_table.php?table_name=address" class="list-group-item list-group-item-action bg-light">Address</a>
        <a href="dy_table.php?table_name=category" class="list-group-item list-group-item-action bg-light">Category</a>
        <a href="dy_table.php?table_name=city" class="list-group-item list-group-item-action bg-light">City</a> 
        <a href="dy_table.php?table_name=country" class="list-group-item list-group-item-action bg-light">Country</a>
        <a href="dy_table.php?table_name=customer" class="list-group-item list-group-item-action bg-light">Customer</a>
        <a href="dy_table.php?table_name=film" class="list-group-item list-group-item-action bg-light">Film</a>
        <a href="dy_table.php?table_name=film_actor" class="list-group-item list-group-item-action bg-light">Film & Actor</a>
        <a href="dy_table.php?table_name=film_category" class="list-group-item list-group-item-action bg-light">Film Category</a>
        <a href="dy_table.php?table_name=film_text" class="list-group-item list-group-item-action bg-light">Film Text</a>
        <a href="dy_table.php?table_name=inventory" class="list-group-item list-group-item-action bg-light">Inventory</a>
        <a href="dy_table.php?table_name=language" class="list-group-item list-group-item-action bg-light">Language</a>
        <a href="dy_table.php?table_name=payment" class="list-group-item list-group-item-action bg-light">Payment</a>
        <a href="dy_table.php?table_name=rental" class="list-group-item list-group-item-action bg-light">Rental</a>
        <a href="dy_table.php?table_name=staff" class="list-group-item list-group-item-action bg-light">Staff</a>
        <a href="dy_table.php?table_name=store" class="list-group-item list-group-item-action bg-light">Store</a> 
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    

    <!-- Page Content -->
    <div class="page-content-wrapper container" id ="database-table">
      <div class="scrollable table-responsive-lg" >
        <table class="table table-hover table-bordered table-striped">
      <?php
        // $table_query = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = `sakila` AND `TABLE_NAME` = \"".$table_name."\";";           
        $table_query = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema = 'sakila' AND table_name ='".$table_name."'";        
        $query_result1 = mysqli_query($conn, $table_query);
        $fetch1 = mysqli_fetch_all($query_result1, MYSQLI_ASSOC);
        // var_dump($fetch1);

        echo '<tr>';
        foreach($fetch1 as $row) {
            echo '<th>'.$row['COLUMN_NAME'].'</th>';
        }
        echo '</tr>';

        $data_query = "SELECT * FROM ".$table_name;
        $query_result2 = mysqli_query($conn, $data_query);
        $fetch2 = mysqli_fetch_all($query_result2, MYSQLI_NUM);
        $row_count = mysqli_num_rows($query_result2);
        $field_count = mysqli_num_fields($query_result2);
        // var_dump($field_count);

        for($i = 0; $i < $row_count; $i++) {
            echo '<tr>';
            for($j = 0; $j < $field_count; $j++) {
                echo'<td>';
                echo $fetch2[$i][$j];
                echo '</td>';
            }
            echo '</tr>';
        }        


      ?>
        </table>
      
      </div>
      
    <!-- /#page-content-wrapper -->
    
    </div>
</div>
</body>
</html>