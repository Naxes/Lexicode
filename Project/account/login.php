<?php 
    require '../includes/db.php';
    session_start();

    $active_page = "login";
    
    // Login
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['login'])){
            // Escape string to protect against SQL Injection
            $email = $mysqli->escape_string($_POST['email']);
            $password = $mysqli->escape_string($_POST['password1']);
            $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
            
            // Check if user exists
            if ($result->num_rows == 0) { // User doesn't exist
                $_SESSION['message'] = "User does not exist";
            }else { // User exists
                $user = $result->fetch_assoc();
                
                if (password_verify($_POST['password1'], $user['password'])){
                    // Session variables
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['userid'] = $user['userid'];
                    
                    //Unhashed password (for details.php)
                    $_SESSION['password'] = $password;
                    
                    // User is logged in
                    $_SESSION['loggedin'] = true;
                    
                    // Successful login
                    $_SESSION['message'] = "Login successful.";
                    
                    // Redirect to home page
                    header('location: ../index.php');
                    
                }else{ // Wrong password
                    $_SESSION['message'] = "The password you entered was incorrect";
                    
                }
            }
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Login</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="../css/output.css"/>
    </head>
    <body>
        <?php 
            if ($_SESSION['loggedin'] === true){
                header('location: ../index.php');
                exit;
            }else {?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-1">
                            <?php include '../includes/content-nav.php'?>
                        </div>
                        
                        <div class="col-10 offset-1">
                            <!-- Login form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="vertical-md"></div>
                                        <h1 class="font-white text-center"><i class="fa fa-user"></i></h1>
                                        <h2 class="font-white font-content text-center">Sign in</h2>
                                        <div class="vertical-md"></div>
                                        
                                        <div class="content-blackbox">
                                            <form method="post" autocomplete="off">
                                                <!-- Email -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="email">Email:</label>
                                                            <input type="email" class="form-control" name="email" autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Password -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="password1">Password:</label>
                                                            <input type="password" class="form-control" name="password1" autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Login button -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary" name="login" value="Login"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="vertical-md"></div>
                                        
                                        <div class="content-blackbox">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <span class="font-white font-content">New? <a href="/Project/account/register.php">Create an account</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="account-nav col-1">
                            <?php include '../includes/account-nav.php'; ?>
                        </div>
                    </div>
                </div>
                <?php
                    // Alert if login fails
                    if (isset($_SESSION['message'])){?>
                        <div class="error-message">
                            <div class="message-content">
                                <?php 
                                    echo $_SESSION['message']; 
                                    unset($_SESSION['message']);
                                ?>
                            </div>
                        </div> 
                    <?php }else { // Display nothing
                     
                    }
                ?>
            <?php }?>
        ?>
    </body>
</html>