<?php
    include_once "../includes/database.php";
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
    <a class="navbar-brand" style = "color:white" href = "../index.php">SAKILA</a>
    <form class="form-inline">
    
  </form>
</nav>
</header>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      
      <div class="list-group list-group-flush">
        <a href="actor.php" class="list-group-item list-group-item-action bg-light">Actor</a>
        <a href="address.php" class="list-group-item list-group-item-action bg-light">Address</a>
        <a href="category.php" class="list-group-item list-group-item-action bg-light">Category</a>
        <a href="city.php" class="list-group-item list-group-item-action bg-light">City</a>
        <a href="country.php" class="list-group-item list-group-item-action bg-light">Country</a>
        <a href="customer.php" class="list-group-item list-group-item-action bg-light">Customer</a>
        <a href="film.php" class="list-group-item list-group-item-action bg-light">Film</a>
        <a href="film_actor.php" class="list-group-item list-group-item-action bg-light">Film & Actor</a>
        <a href="film_category.php" class="list-group-item list-group-item-action bg-light">Film Category</a>
        <a href="film_text.php" class="list-group-item list-group-item-action bg-light">Film Text</a>
        <a href="inventory.php" class="list-group-item list-group-item-action bg-light">Inventory</a>
        <a href="language" class="list-group-item list-group-item-action bg-light">Language</a>
        <a href="payment.php" class="list-group-item list-group-item-action bg-light">Payment</a>
        <a href="rental.php" class="list-group-item list-group-item-action bg-light">Rental</a>
        <a href="staff.php" class="list-group-item list-group-item-action bg-light">Staff</a>
        <a href="store.php" class="list-group-item list-group-item-action bg-light">Store</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    

    <!-- Page Content -->
    <div class="page-content-wrapper container" >
      
      
      
    </div>
    <!-- /#page-content-wrapper -->
    
    </div>
</div>
</body>
</html>