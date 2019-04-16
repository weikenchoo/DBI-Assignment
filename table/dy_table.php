<?php
    include "../includes/database.php";
	  session_start();
	
    if(!isset($_SESSION['login_user'])){
      header('Location: ../loginpage.php');
    }

    $response = "";
    $conn = connect();
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
        // var_dump($_SESSION);
    }
  
    function alert($id) {
      // echo $id;
    }

	if(isset($_POST['logout'])){
	    session_destroy();
	    header('location: ../loginpage.php');
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
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style2.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <script src="main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>

<body>
<header>
<nav class="navbar navbar-dark bg-dark">
  <div class="d-flex justify-content-start">
    <div class="row">
      <button type="button" id="sidebarCollapse" class="btn" style="margin-left:20px">  
          <i class="fas fa-align-left"></i>
      </button>
      <a class="col-sm-3 navbar-brand" style="color:white;margin-left:10px" href="../index.php">SAKILA</a>
    </div>
  </div>

  <div class="d-flex justify-content-end">
    <div class="navbar">
      <div class="nav-item">
        <?php 
          echo '<a class="nav-link" href="../form/'.$table_name.'/insert.php">Insert</a>';
        ?>
      </div>
    </div>
  <div class="navbar" >
  <div class="nav-item">
  
    <form method="POST">
        <button type="submit" class="btn btn-default btn-sm" name="logout">
          <i class="fas fa-sign-out-alt"></i> Log out
        </button>
    </form>
  </div>
  </div>
  </div>
</nav>
</header>

<div class="d-flex" id="wrapper">
<nav id="sidebar">
    <!-- Sidebar -->
        <a href="dy_table.php?table_name=actor" class="list-group-item list-group-item-action bg-light">Actor</a>
        <a href="dy_table.php?table_name=address" class="list-group-item list-group-item-action bg-light">Address</a>
        <a href="dy_table.php?table_name=category" class="list-group-item list-group-item-action bg-light">Category</a>
        <a href="dy_table.php?table_name=city" class="list-group-item list-group-item-action bg-light">City</a> 
        <a href="dy_table.php?table_name=country" class="list-group-item list-group-item-action bg-light">Country</a>
        <a href="dy_table.php?table_name=customer" class="list-group-item list-group-item-action bg-light">Customer</a>
        <a href="dy_table.php?table_name=film" class="list-group-item list-group-item-action bg-light">Film</a>
        <a href="dy_table.php?table_name=film_actor" class="list-group-item list-group-item-action bg-light">Film & Actor</a>
        <a href="dy_table.php?table_name=film_category" class="list-group-item list-group-item-action bg-light">Film Category</a>
        <a href="dy_table.php?table_name=inventory" class="list-group-item list-group-item-action bg-light">Inventory</a>
        <a href="dy_table.php?table_name=language" class="list-group-item list-group-item-action bg-light">Language</a>
        <a href="dy_table.php?table_name=payment" class="list-group-item list-group-item-action bg-light">Payment</a>
        <a href="dy_table.php?table_name=rental" class="list-group-item list-group-item-action bg-light">Rental</a>
        <a href="dy_table.php?table_name=staff" class="list-group-item list-group-item-action bg-light">Staff</a>
        <a href="dy_table.php?table_name=store" class="list-group-item list-group-item-action bg-light">Store</a> 
</nav>
    <!-- /#sidebar-wrapper -->

    <?php 
        $table_query = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema = 'sakila' AND table_name ='".$table_name."'";        
        $query_result1 = mysqli_query($conn, $table_query);
        $fetch1 = mysqli_fetch_all($query_result1, MYSQLI_ASSOC);
                
        
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])) {
          $primary_key = $_POST['primary_key'];          
          
          $delete_query = "DELETE FROM ".$table_name." WHERE ".$fetch1[0]['COLUMN_NAME']." = ".$primary_key." ";
          if(mysqli_query($conn, $delete_query) === TRUE) {
				$delete_check = 1;
				
          } 
		  else {
			    $delete_check = 0;

          }

        }
        
    ?>

    

    <!-- Page Content -->
    <div class="page-content-wrapper container mh-100" id ="database-table">
    <p class="lead container" style="padding-left:20px">  <?php echo $response; $response=""; ?> </p>    
      <!-- Testing search bar -->
      <!-- <div class="input-group md-form form-sm form-1 pl-0">
        <div class="input-group-prepend">
          <span class="input-group-text " id="searchInput"><i class="fas fa-search text-white"
              aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
      </div> -->

        <!-- TODO: format the header  -->
          <?php
              echo '<h1>'.$table_name.'</h1>'; 
          ?>
      <div class="scrollable table-responsive-md" >
        <table class="table table-hover table-bordered table-striped">
          <thead class="thead-dark">
      <?php
        echo '<tr>';
        foreach($fetch1 as $row) {
            echo '<th>'.$row['COLUMN_NAME'].'</th>';
        }
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        $data_query = "SELECT * FROM ".$table_name;
        $query_result2 = mysqli_query($conn, $data_query);
        $fetch2 = mysqli_fetch_all($query_result2, MYSQLI_NUM);
        $row_count = mysqli_num_rows($query_result2);
        $field_count = mysqli_num_fields($query_result2);


        for($i = 0; $i < $row_count; $i++) {
            echo '<tr>';
            
            
            for($j = 0; $j < $field_count; $j++) {
                echo'<td>';
                echo $fetch2[$i][$j];
                echo '</td>';
            }

            // different template for JOINT tables 
            if($table_name == "film_actor" || $table_name == "film_category") {
                echo '<td>
                        <div class="container">
                        <div class="row">
                        <a class="col-xs-4" style="color:black" href="../form/'.$table_name.'/update.php?id1='.$fetch2[$i][0].'&id2='.$fetch2[$i][1].'"><i class="far fa-edit"></i>Update</a>
                        <form method = "POST">
                        <input type= "hidden" name="primary_key" value = '.$fetch2[$i][0].'> 
                        <button class="unstyled-button" name="delete" type="submit" onClick=\'return confirm("Are you sure?");\'>

                        <i class="fa fa-trash" aria-hidden="true"></i>Delete
                        </form>                         
                        </div>
                        </div>
                          ';
                  echo '</tr>';

            } else {
                  echo '<td>
                        <div class="container">
                        <div class="row">
                        <a class="col-xs-4" style="color:black" href="../form/'.$table_name.'/update.php?id='.$fetch2[$i][0].'"><i class="far fa-edit"></i>Update</a>
                        <form method = "POST">
                        <input type= "hidden" name="primary_key" value = '.$fetch2[$i][0].'> 
                        <button class="unstyled-button" name="delete" type="submit" onClick=\'return confirm("Are you sure?");\'>
                        <i class="fa fa-trash" aria-hidden="true"></i>Delete
                        </button>
                        
                        </form> 
                        </div>
                        </div>
                          ';
                  echo '</tr>';
            }
        }        
		
		if(isset($_SESSION['check'])){
			echo "<script type='text/javascript'>
				alert('Database updated successfully!');
				</script>";
				
			unset($_SESSION['check']);
		}
		
		if(isset($delete_check) && $delete_check == 1){
			echo "<script type='text/javascript'>
				alert('Delete successful!');
				</script>";
			unset($delete_check);
		}
		else if (isset($delete_check) && $delete_check == 0){
			echo "<script type='text/javascript'>
				alert('Delete was unsuccessful!');
				</script>";
			unset($delete_check);
		}
		
		if(isset($_SESSION['update_check'])){
			echo "<script type='text/javascript'>
				alert('Update successful!');
				</script>";
				
			unset($_SESSION['update_check']);
		}
			

      ?>
      <!-- <a class="col-xs-4" style="color:black" href="../form/'.$table_name.'/update.php"><i class="far fa-edit"></i>Update</a>
      <a class="col-xs-4" style="color:black" href="../form/'.$table_name.'/update.php?id='.$fetch2[$i][0].'"><i class="far fa-edit"></i>Update</a> -->

        </table>
      
      </div>
      
    <!-- /#page-content-wrapper -->
    
    </div>
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