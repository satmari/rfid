<?php

// Include config file
require_once "config.php";

session_start();

if(!$_SESSION['loggedin']){
   header("location:login.php");
   die;
}
 
// Define variables and initialize with empty values
   $roll = $dc_qty = $real_qty = $lost = $lost_clb = $invalid = "";
   $roll_err = $dc_qty_err = $real_err = $lost_err = $lost_clb_err = $invalid_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")

{
    // Validate ID
   
    $input_roll = trim($_POST["roll"]);
    if(empty($input_roll)){
        $roll_err = "Check roll ID.";     
    }  else{
        $roll = $input_roll;
    }
    
    // Validate Declare QTY
    
    $input_dc_qty = 3500;
    if(empty($input_dc_qty)){
        $dc_qty_err = "Please enter declared QTY.";     
    }  else{
        $dc_qty = $input_dc_qty;
    }
    
    // Validate REAL QTY
    
    $input_real_qty = trim($_POST["real_qty"]);
    if($input_real_qty==" " OR filter_var($input_real_qty, FILTER_VALIDATE_INT) === false){
      $real_err = "Check real QTY.";     
    }  else{
      $real_qty = $input_real_qty;
    }

    // Validate LOST

    $input_lost = trim($_POST["lost"]);
    if($input_lost==" " OR filter_var($input_lost, FILTER_VALIDATE_INT) === false){
      $lost_err = "Check Lost QTY.";     
    }  else{
      $lost = $input_lost;
    }
    
    //Validate LOST_CLB

    $input_lost_clb = trim($_POST["lost_clb"]);
    if($input_lost_clb==" " OR filter_var($input_lost_clb, FILTER_VALIDATE_INT) === false){
      $lost_clb_err = "Check Calibration QTY.";     
    }  else{
      $lost_clb = $input_lost_clb;
    }


    $input_invalid = trim($_POST["invalid"]);
    if($input_invalid==" " OR filter_var($input_invalid, FILTER_VALIDATE_INT) === false){
      $invalid_err = "Check Invalid QTY.";     
    }  else{
      $invalid = $input_invalid;
    }

    // Check input errors before inserting in database
    if(empty($roll_err) && empty($dc_qty_err) && empty($real_err) && empty($lost_err) && empty($lost_clb_err) && empty($invalid_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO labels (roll_id, declared_qty, real_qty, lost, lost_clb, invalid) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_roll_id, $param_declared_qty, $param_real_qty, $param_lost, $param_lost_clb, $param_invalid);
            
            // Set parameters
            $param_roll_id = $roll;
            $param_declared_qty = $dc_qty;
            $param_real_qty = $real_qty;
            $param_lost = $lost;
            $param_lost_clb = $lost_clb;
            $param_invalid = $invalid;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: landing.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Dodaj Rolnu</h2>
                    </div>
                    <p>Popunite tabelu sa količinama.</p><br><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($dc_qty_err)) ? 'has-error' : ''; ?>">
                            <label>Total QTY</label>
                            <input type="hidden" name="dc_qty" class="form-control"><?php echo 3500; ?></input>
                            <span class="help-block"><?php echo $dc_qty_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($real_err)) ? 'has-error' : ''; ?>">
                            <br><label>Good QTY</label>
                            <input type="number" name="real_qty" min="0" max="3500" class="form-control" value="<?php echo $real_qty; ?>">
                            <span class="help-block"><?php echo $real_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($lost_err)) ? 'has-error' : ''; ?>">
                            <label>Lost QTY</label>
                            <input type="number" name="lost" min="0" max="100" class="form-control" value="<?php echo $lost; ?>">
                            <span class="help-block"><?php echo $lost_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($lost_clb_err)) ? 'has-error' : ''; ?>">
                            <label>Lost during calibration</label>
                            <input type="number" name="lost_clb" min="0" max="100" class="form-control" value="<?php echo $lost_clb; ?>">
                            <span class="help-block"><?php echo $lost_clb_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($invalid_err)) ? 'has-error' : ''; ?>">
                            <label>Invalid print/cut labels</label>
                            <input type="number" name="invalid" min="0" max="500" class="form-control" value="<?php echo $invalid; ?>">
                            <span class="help-block"><?php echo $invalid_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($roll_err)) ? 'has-error' : ''; ?>">
                            <label>LOT NO.</label>
                            <input type="text" name="roll" class="form-control" value="<?php echo $roll; ?>">
                            <span class="help-block"><?php echo $roll_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="landing.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>