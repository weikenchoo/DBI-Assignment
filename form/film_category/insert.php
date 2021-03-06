<?php
    include "../../includes/database.php";
	include "../../includes/check_login.php";
    $conn = connect();
    $response = "";
	
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$film_id = isset($_POST['film_id'])?$_POST['film_id']:""; 
		$category_id = isset($_POST['category_id'])?$_POST['category_id']:"";
		
		$sql = "INSERT INTO film_category(film_id ,category_id) 
					VALUES('$film_id','$category_id')";
		
	if($category_id != 'NULL' && $film_id != 'NULL'){
			$result = mysqli_query($conn, $sql);
		if($result === TRUE){
			$_SESSION['check'] = 1;
			header('location:../../table/dy_table.php?table_name=film_category');
		}

			else
				$response = "Insert failed.";
		}
	
	else if($film_id == 'NULL' && $category_id != 'NULL'){
		$response = "No available film.";
	}

	else if($category_id == 'NULL' && $film_id != 'NULL'){
		$response = "No available category.";
	}
	
	else if($category_id == 'NULL' && $film_id == 'NULL'){
		$response = "No available category and film.";
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
      <a class="nav-link" href="../../table/dy_table.php?table_name=film_category">Update</a>
      <a class="nav-link" href="../../table/dy_table.php?table_name=film_category">Delete</a>
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
            <h3 class="mb-0">Film category</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" id="formInsert"  method="POST">
            <div class="form-group">
              <label for="film_id">Film</label>              
						<?php
                            echo ' <select class="form-control form-control-lg" name="film_id" id="film_id"> ';
							$sql2 = "SELECT f.film_id, f.title FROM film f WHERE 
							NOT EXISTS (SELECT fc.film_id FROM film_category fc where f.film_id = fc.film_id)
							ORDER BY title";
							$film_search = mysqli_query($conn, $sql2);
							if(mysqli_num_rows($film_search) > 0){
								while($row = mysqli_fetch_assoc($film_search)){
									echo "<option value='" . $row['film_id'] . "'>" . $row['title'] . "</option>";
                                }
							}
							else{
								echo "<option value='NULL'> --NULL-- </option>";
							}
                            echo "</select>";
						?>
            </div>
            <div class="form-group">
              <label for="category_id">Category</label>          
						<?php
                            echo ' <select class="form-control form-control-lg" name="category_id" id="category_id">';
							$sql3 = "SELECT category_id, name FROM category ORDER BY name";
							$category_search = mysqli_query($conn, $sql3);
							if(mysqli_num_rows($category_search) > 0){
								while($row = mysqli_fetch_assoc($category_search)){
									echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                                }
							}
							else{
								echo "<option value='NULL'> --NULL-- </option>";
							}
                            echo "</select>";
						?>
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