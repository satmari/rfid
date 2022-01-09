<?php

require_once "config.php";

session_start();

if(!$_SESSION['loggedin']){
   header("location:login.php");
   die;
}


$gbin = "";
$gbin_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST")

{
    // Validate ID
   
    $input_gbin = trim($_POST["gbin"]);
    if(empty($input_gbin)){
        $gbin_err = "Check gbin.";     
    }  else{
        $gbin = $input_gbin;
    }

	$input_printed = 0;
    if(empty($input_printed)){
        $printed_err = "Please enter declared QTY.";     
    }  else{
        $printed = $input_printed;
    }


	if(empty($gbin_err) && empty($printed)){
        // Prepare an insert statement
        $sql = "INSERT INTO gbin (gbin, printed) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_gbin, $param_printed);
            
            // Set parameters
            $param_gbin = $gbin;
      		$param_printed = 0;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: test.php");
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
                        <h2>GBIN SCAN</h2>
                    </div>
                    <p>Skenirajte polje: </p><br><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($gbin_err)) ? 'has-error' : ''; ?>">
                            <label>GBIN</label>
                            <input type="text" name="gbin" class="form-control" value="<?php echo $gbin; ?>">
                            <span class="help-block"><?php echo $gbin_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="test.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>