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
    <a class="nav-link" href="update.php">Update</a>
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
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Film</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required="">
                      <div class="invalid-feedback">Oops, you missed this one.</div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Release year</label>
                      <input type="text" class="form-control form-control-sm rounded-0" name="release_year" id="release_year" required="">
                      <div class="invalid-feedback">Oops, you missed this one.</div>
                  </div>
                </div>
              </div>
                
              <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control form-control-sm rounded-0" name="desc" id="" cols="10" rows="2" required=""></textarea>
                  
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                      <label for="lang">Language</label>
                      <select id="language" class="form-control form-control-sm" size="0" required="">
                        
                        <option value="">English</option>
                        <option value="">Chinese</option>
                      </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <label for="ori">Original language</label>
                      <select class="form-control form-control-sm" name ="original_language_id" id="language"  size="0">
                        <option value="null">--NULL--</option>
                        <option value="">English</option>
                        <option value="">Chinese</option>
                      </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <label>Rental duration</label>
                      <input type="number" class="form-control form-control-sm " name="rental_duration" id="rental_duration" required="" >
                      
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Length</label>
                        <input type="number" class="form-control form-control-sm " name="length" id="length" required="" >
                        
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label>Replacement cost</label>
                        <input type="number" class="form-control form-control-sm " name="replacement_cost" id="replacement_cost" step ="0.01" required="" >
                        
                    </div>
                  </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <label>Rental rate</label>
                      <input type="number" class="form-control form-control-sm rounded-0" name="rental_rate" id="rental_rate" step ="0.01" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label>Rating</label>
                      <select name="rating" id="rating" class="form-control form-control-sm" required="">
                        <option value="">G</option>
                        <option value="">R</option>
                        <option value="">PG-13</option>
                        <option value="">PG</option>
                        <option value="">NC-17</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label>Special features</label>
                      <select multiple name="special_features" id="special_features" class="form-control form-control-sm" required="">
                        <option value="">Behind the scenes</option>
                        <option value="">Trailers</option>
                        <option value="">Commentaries</option>
                        <option value="">Deleted scenes</option>
                      </select>
                  </div>
                </div>
              </div>
              
              
                
              <button type="submit" class="btn btn-outline-dark " >Insert</button>
            </form>
        </div>
      
    
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
</body>
</html>