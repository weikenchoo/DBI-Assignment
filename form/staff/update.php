<?php
    include "../../includes/database.php";
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
    <a class="nav-link" href="./../table/dy_table.php?table_name=staff">Update</a>
    <a class="nav-link" href="./../table/dy_table.php?table_name=staff">Delete</a>
  </div>
</nav>
<style>
.radio{
    margin-left: 15px;
}
</style>
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
    <div class="page-content-wrapper container" id ="database-table">
    <div class="card">
        <div class="card-header">
        <!-- this is for table -->
            <h4 class="mb-0">Staff</h4>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off">
            <div class="form-row">
                    <div class="col">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="first_name" id="first_name" required="">
                    </div>
                    <div class="col">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="last_name" id="last_name" required="">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="username" id="username" required="">
                    </div>
                    <div class="col">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-sm rounded-0" name="password" id="password" required="" autocomplete="new-password">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-sm rounded-0 col-sm-6" name="email" id="email" required="">
                </div>
                <div class="form-group">
                    <label for="picture">Insert Picture</label>
                    <input type="file" class="form-control-file" name="picture" id="picture">
                </div>
                <div class="form-group">
                    <label for="address_id">Address ID</label>
                        <select type="text" name="address_id" id="address_id" class="form-control form-control-sm rounded-0 col-sm-6">
                            <option value="">Kuala Lumpur</option>
                            <option value="">Bandar Sunway</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="store_id">Store ID</label>
                        <select type="number" name="store_id" id="store_id" class="form-control form-control-sm rounded-0 col-sm-6">
                            <option value="">01234</option>
                            <option value="">56789</option>
                        </select>
                </div>
                <label for="active">Active</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="active" id="active">
                    <label class="form-check-label" for="active">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="active" id="active">
                    <label class="form-check-label" for="active">No</label>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-lg-9">
                        <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=staff'" >
                        <input type="button" class="btn btn-outline-dark" value="Save Changes">
                    </div>
                </div>
            </form>
        </div>
    </div>
      
    
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
</body>
</html>