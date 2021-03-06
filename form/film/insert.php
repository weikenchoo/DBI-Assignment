<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
    $conn = connect();
    $response = "";
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$title = isset($_POST['title'])?strtoupper($_POST['title']):""; 
		$description = isset($_POST['description'])?$_POST['description']:"";
		$release_year = isset($_POST['release_year'])?$_POST['release_year']:"";
		$language_id = isset($_POST['language_id'])?$_POST['language_id']:"";
		$original_language_id = isset($_POST['original_language_id'])?$_POST['original_language_id']:"";
		$rental_duration = isset($_POST['rental_duration'])?$_POST['rental_duration']:"";
		$rental_rate = isset($_POST['rental_rate'])?$_POST['rental_rate']:"";
		$length = isset($_POST['length'])?$_POST['length']:"";
		$replacement_cost = isset($_POST['replacement_cost'])?$_POST['replacement_cost']:"";
		$rating = isset($_POST['rating'])?$_POST['rating']:"";
		$special_features_array[] = $_POST['special_features_array'];//array to store multiple selections of special_features
		
	if(count($_POST['special_features_array'])>0){
			$special_features = implode(",",$special_features_array[0]); //an array of arrays, so use $special_features_array[0]
       }
    

	$query1 = "INSERT INTO film(title, description, release_year, language_id, original_language_id, rental_duration, rental_rate, length, replacement_cost, rating, special_features) 
				VALUES('$title', '$description', '$release_year', '$language_id', '$original_language_id', '$rental_duration', '$rental_rate', '$length', 
				'$replacement_cost', '$rating', '$special_features')";
					
	if($language_id != 'NULL'){
		$result = mysqli_query($conn, $query1);
		if($result === TRUE){
			$_SESSION['check'] = 1;
			header('location:../../table/dy_table.php?table_name=film');
		}
		else
			$response = "Insert failed.";
		}
			
		else{
			$response = "No available language.";
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
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="main.js"></script>
</head>

<body>
<header>
<nav class="navbar navbar-dark bg-dark">
    <div class="d-flex justify-content-start">
        <div class="row">
        <button type="button" id="sidebarCollapse" class="btn" style="margin-left:20px">  
            <i class="fas fa-align-left"></i>
        </button>
        <a class="col-sm-3 navbar-brand" style="color:white;margin-left:10px" href="../../index.php">SAKILA</a>
        </div>
    </div>
    <div class="navbar nav-item" >
      <a class="nav-link" href="insert.php">Insert</a>
      <a class="nav-link" href="../../table/dy_table.php?table_name=film">Update</a>
      <a class="nav-link" href="../../table/dy_table.php?table_name=film">Delete</a>
    </div>
</nav>
</header>

<div class="d-flex" id="wrapper">
<nav id="sidebar">
    <!-- Sidebar -->
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
</nav>
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
                      <label for="title">Title</label>
                      <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required="">
                      
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="release_year">Release year</label>
                      <input type="text" class="form-control form-control-sm rounded-0" name="release_year" id="release_year" required="">
                      
                  </div>
                </div>
              </div>
                
              <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control form-control-sm rounded-0" name="description" id="" cols="10" rows="2" required=""></textarea>
                  
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                      <label for="lang">Language</label>
					  <?php
                      echo "<select name='language_id' id='language' class='form-control form-control-sm' size='0' required=''>";
					  $query2 = "SELECT language_id, name FROM language";
					  $language_search = mysqli_query($conn, $query2);
					  if(mysqli_num_rows($language_search) > 0){
						  while($row = mysqli_fetch_assoc($language_search)){
							  echo "<option value='" . $row['language_id'] . "'>" . $row['name'] . "</option>";
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
                      <label for="ori">Original language</label>
					  <?php
                      echo "<select name='original_language_id' id='language' class='form-control form-control-sm' size='0' required=''>";
					  $query3 = "SELECT language_id, name FROM language";
					  $language_search = mysqli_query($conn, $query3);
					  if(mysqli_num_rows($language_search) > 0){
						  while($row = mysqli_fetch_assoc($language_search)){
							  echo "<option value='" . $row['language_id'] . "'>" . $row['name'] . "</option>";
						  }
					  }
					  echo "<option value = ''>" . "--NULL--" . "</option>";
                      echo "</select>";
					  ?>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <label for="rental_duration">Rental duration</label>
                      <input type="number" class="form-control form-control-sm " name="rental_duration" id="rental_duration" required="" >
                      
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="number" class="form-control form-control-sm " name="length" id="length" required="" >
                        
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label for="replacement_cost">Replacement cost</label>
                        <input type="number" class="form-control form-control-sm " name="replacement_cost" id="replacement_cost" step ="0.01" required="" >
                        
                    </div>
                  </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <label for="rental_rate">Rental rate</label>
                      <input type="number" class="form-control form-control-sm rounded-0" name="rental_rate" id="rental_rate" step ="0.01" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="rating">Rating</label>
                      <select name="rating" id="rating" class="form-control form-control-sm" required="">
                        <option value="G">G</option>
                        <option value="R">R</option>
                        <option value="PG">PG</option>
                        <option value="PG-13">PG-13</option>
                        <option value="NC-17">NC-17</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="special_features">Special features</label>
                      <select multiple name="special_features_array[]" id="special_features" class="form-control form-control-sm" required="">
                        <option value="Behind the scenes">Behind the scenes</option>
                        <option value="Trailers">Trailers</option>
                        <option value="Commentaries">Commentaries</option>
                        <option value="Deleted scenes">Deleted scenes</option>
                      </select>
                  </div>
                </div>
              </div>
              
              
                
              <button type="submit" class="btn btn-outline-dark " >Insert</button>
            </form>
        </div>
      
    <p class="lead container" style="padding-left:20px">  <?php echo $response; $response=""; ?> </p>
    
    </div>
    <!-- /#page-content-wrapper -->
</div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>
</html>

<?php


mysqli_close($conn);
//close connection

?>