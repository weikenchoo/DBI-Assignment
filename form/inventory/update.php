<?php
    include "../../includes/database.php";
    include "../../includes/check_login.php";

    $conn = connect();

    $response = "";
    
    if(isset($_GET["table_name"])) {
        $table_name = $_GET["table_name"];
    }
    
    if(isset($_GET["id"])) {
        $_SESSION['id'] = $_GET["id"];
        $id = $_SESSION['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $check_query = "SELECT * FROM inventory WHERE inventory_id = ".$id;
        $check_result = mysqli_query($conn, $check_query);
        $fetch = mysqli_fetch_all($check_result, MYSQLI_ASSOC);        

        $film_id = !empty($_POST['film_id'])?$_POST['film_id']:$fetch[0]['film_id'];
        $store_id = !empty($_POST['store_id'])?$_POST['store_id']:$fetch[0]['store_id'];

        $update_query = "UPDATE inventory SET film_id='".$film_id."', store_id='".$store_id."' WHERE inventory_id = ".$id;

        $result = mysqli_query($conn, $update_query);
        if($result) {
            unset($_SESSION['id']);
			$_SESSION['update_check'] = 1;
            header('Location: ../../table/dy_table.php?table_name=inventory');
        } else {
            $response = "Insert failed.";
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
        <a class="nav-link" href="../../table/dy_table.php?table_name=inventory">Update</a>
        <a class="nav-link" href="../../table/dy_table.php?table_name=inventory">Delete</a>
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
    <div class="card">
        <div class="card-header">
        <!-- this is for table -->
            <h3 class="mb-0">Inventory</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" method = "POST">
            <div class="form-row">
                    <div class="col">
                        <label for="film_id">Film</label>
                        <?php
                            $check_query2 = "SELECT film_id FROM inventory WHERE inventory_id =".$id;
                            $original_film = mysqli_fetch_all(mysqli_query($conn, $check_query2), MYSQLI_ASSOC);

                            $options_query = "SELECT title, film_id FROM film ORDER BY title";
					        $city_search = mysqli_query($conn, $options_query);
					
                            echo "<select id='film' class='form-control' size='0' name='film_id'>";
                            if(mysqli_num_rows($city_search) > 0){
                                while($row = mysqli_fetch_assoc($city_search)) {
                                    if($row['film_id'] == $original_film[0]['film_id']) {
                                        echo "<option value='" . $row['film_id'] . "' selected>" . $row['title'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row['film_id'] . "'>" . $row['title'] . "</option>";
                                    }                                    
                                }
                            }
                            else 
                                echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                                    echo "</select>";
					?>  
                    </div>
                    <div class="col">
                        <label for="Store_id">Store ID</label>
                        <?php
                            $check_query3 = "SELECT store_id FROM inventory WHERE inventory_id =".$id;
                            $original_store = mysqli_fetch_all(mysqli_query($conn, $check_query3), MYSQLI_ASSOC);

                            $options_query = "SELECT store_id FROM store ORDER BY store_id";
					        $store_search = mysqli_query($conn, $options_query);
					
                            echo "<select id='store' class='form-control' size='0' name='store_id'>";
                            if(mysqli_num_rows($store_search) > 0){
                                while($row = mysqli_fetch_assoc($store_search)) {
                                    if($row['store_id'] == $original_store[0]['store_id']) {
                                        echo "<option value='" . $row['store_id'] . "' selected>" . $row['store_id'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row['store_id'] . "'>" . $row['store_id'] . "</option>";
                                    }                                    
                                }
                            } else {
                                    echo "<option value = 'NULL'>" . "--NULL--" . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-lg-9">
                        <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='../../table/dy_table.php?table_name=inventory'" >
                        <input type="submit" class="btn btn-outline-dark" value="Save Changes">
                    </div>
                </div>
            </form>
        </div>
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