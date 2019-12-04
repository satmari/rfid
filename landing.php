<!DOCTYPE html>

<?php

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);

session_start();

if(!$_SESSION['loggedin']){
   header("location:login.php");
   die;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 50%;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-12 text-center">
                    <div class="page-header clearfix"><br>
                        <a href="logout.php" class="btn btn-danger float-left">Logout</a>
                        <h2 class="float-right">RFID Tabela</h2><br><br><br>
                        <a href="create.php" class="btn btn-success float-right">Dodaj Rolnu</a>
						<a href="http://172.27.161.221/Reports_GPD/Pages/Report.aspx?ItemPath=%2fTEST+SSRS%2fPreparation%2fRFID" class="btn btn-info float-left">Report</a>
                    <br><br>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM labels order by id desc";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped table-hover table-sm'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>LOT NO.</th>";
                                        echo "<th>Total QTY</th>";
                                        echo "<th>Good QTY</th>";
                                        echo "<th>Lost QTY <br> (double line)</th>";
                                        echo "<th>Lost during <br> calibration</th>";
                                        echo "<th>Lost <br>bad cut/print</th>";
                                        echo "<th></th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['roll_id'] . "</td>";
                                        echo "<td>" . $row['declared_qty'] . "</td>";
                                        echo "<td>" . $row['real_qty'] . "</td>";
                                        echo "<td>" . $row['lost'] . "</td>";
                                        echo "<td>" . $row['lost_clb'] . "</td>";
                                        echo "<td>" . $row['invalid'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='reprint.php?id=". $row['id'] ."' title='' data-toggle='tooltip'><span class='badge badge-warning'>Reprint</span></a>";
                                        //echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        //echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Nema unetih stavki.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>