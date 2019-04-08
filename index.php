<?php
    include_once "includes/database.php";
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Interface for SAKILA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="main.js"></script>
</head>

<body>
<header>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" style = "color:white" href = "#">SAKILA</a>
    <form class="form-inline">
    
  </form>
</nav>
</header>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Actor</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Address</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Category</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">City</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Country</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Customer</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Film</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Film & Actor</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Film Category</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Film Text</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Inventory</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Language</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Payment</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Rental</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Staff</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Store</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    

    <!-- Page Content -->
    <div class="page-content-wrapper container" >
      <!-- Insert, update and delete button -->
        <div class="d-flex justify-content-end btn-group" style="background-color:white">
          <button class="btn btn-primary btn-lg col-lg-1">Insert</button>
          <button class="btn btn-primary btn-lg col-lg-1">Update</button>
          <button class="btn btn-primary btn-lg col-lg-1">Delete</button>
        </div>
      <!-- Table for data -->
      <div class="table-responsive-lg">
        <table class="table table-hover table-bordered table-striped">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
          </tr>
          <?php
            $sql = "select * from users;";
            $results = mysqli_query( $connection,$sql);
            $checkResults = mysqli_num_rows($results);
            if ($checkResults > 0 ) {
              while($rows = mysqli_fetch_assoc($results)){
                  echo "<tr><td>" . $rows["user_id"]. 
                      "</td><td>". $rows["username"]. 
                      "</td><td>". $rows["pwd"]. "</td></tr>";
              }
              echo "</table>";
            }
            else{
              echo "0 results";
            }
          ?>
          
        
      </div> 
      
      
    </div>
    <!-- /#page-content-wrapper -->
    
    </div>
</div>
</body>
</html>