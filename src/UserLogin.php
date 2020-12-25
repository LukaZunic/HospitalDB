<?php

    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("Location: index.php");
        exit;
    }

    require 'database.php';

    $username = $password = "";
    $username_err = $password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username";
        }else{
            $username = trim($_POST["username"]);
        }


        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)){

            $sql = "SELECT uid, username, pwd FROM users WHERE username=?";

            if($stmt = mysqli_prepare($conn,$sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = $username;

                if(mysqli_stmt_execute($stmt)){

                    mysqli_stmt_store_result($stmt);

                    if($stmt->num_rows() == 1){
                        mysqli_stmt_bind_result($stmt,$uid,$username,$hashed_password);

                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $uid;
                                $_SESSION["username"] = $username;  

                                echo "<script>console.log('made it here')</script>";
                                print_r($_SESSION);
                                header("Location: index.php");
                            }else{
                                $password_err = "Incorrect password";
                            }
                        }
                    }else{
                        $username_err = "No user in database";
                    }

                }else{
                    echo "Oops! Something went wrong. Please try again later.";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/loginStyle.css">
    
</head>
<body>
    <div class="wrap">
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <b>Please fill in your credentials to login.</b>
            <p></p>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enter">
            </div>
        </form>
    </div>  
     
</body>
</html>

