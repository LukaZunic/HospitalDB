<?php
    //https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php


    require 'database.php';

    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        }else{
            //https://www.php.net/manual/en/mysqli.prepare.php
            $sql = "SELECT uid FROM users WHERE username=?";
            if($stmt = mysqli_prepare($conn,$sql)){
                //https://www.php.net/manual/en/mysqli-stmt.bind-param.php

                // "s" => corresponding variable has type string
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["username"]);

                //Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    $username = trim($_POST["username"]);
                }else{
                    echo "error";
                }
                mysqli_stmt_close($stmt);
            }
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

            $sql = "INSERT INTO users (username,pwd) VALUES (?, ?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("Location: index.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        // Close connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
<head>

<title>Create User</title>

    <meta charset="utf-8">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tableStyle.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/topStyle.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="parseTable.js"></script>
    <script src="checkAd.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   
</head>

<body>

    <div class="topnav">
       
       <img src="resources/whoWhite.png" id="who" >
       <div id="nav">
           <a href="index.php" class="active">Home</a>
           <a href="pharmacy.php">Pharmacy</a>
           <a href="bloodBank.php">Blood Bank</a>
       </div>
   
       <div id="ad"></div>
       <div id="con"></div>

       <style>
           .topnav a:hover{ color: white !important; }
           #ad{ margin-left: 60%; }
           #con{ margin-left: 80%; }
       </style>


   </div>

   <div class="wrap">
        <div class="back"></div>
    </div>

    <!--
        Why use echo htmlspecialchars($_SERVER["PHP_SELF"]); ?
        https://www.w3schools.com/php/php_form_validation.asp
    -->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="inp">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="Submit" id="fir">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>
    </form>

    <style>
        #fir{
            opacity: 100% !important;
            margin-bottom: 3px;
        }

        .help-block{
            color: red;
        }

        .inp{
            margin: auto;
            padding-top: 5px;
            width: 50%;
        }
    </style>


</body>