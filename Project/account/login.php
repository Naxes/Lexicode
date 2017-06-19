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
                $_SESSION['message'] = "User <b>does not exist</b>";
            }else { // User exists
                $user = $result->fetch_assoc();
                
                if (password_verify($_POST['password1'], $user['password'])){
                    // Session variables
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    
                    //Unhashed password (for details.php)
                    $_SESSION['password'] = $password;
                    
                    // User is logged in
                    $_SESSION['loggedin'] = true;
                    
                    // Successful login
                    $_SESSION['message'] = "Login <b>successful</b>.";
                    
                    // Redirect to home page
                    header('location: ../index.php');
                    
                }else{ // Wrong password
                    $_SESSION['message'] = "The password you entered was <b>incorrect</b>";
                    
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
                <div class="vertical-lg"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <?php include '../includes/navigation.php'?>
                        </div>
                        
                        <div class="col-md-9">
                            <span class="font-grey_light font-header">LOGIN</span>
                            <h3 class="font-white font-subheader">Access an Account</h3>
                            
                            <div class="vertical-sm"></div>
                            
                            <!-- Login form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="post" autocomplete="off">
                                            <!-- Email -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-xs-2">
                                                        <label class="font-white" for="email">Email:</label>
                                                        <input type="email" class="form-control" name="email" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Password -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-xs-2">
                                                        <label class="font-white" for="password1">Password:</label>
                                                        <input type="password" class="form-control" name="password1" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" name="login" value="Login"></input>
                                        </form>
                                    </div>
                                    
                                    <!-- Register link -->
                                    <div class="col-md-6">
                                        <h3 class="font-white">Not a Member?</h3>
                                        <span class="font-white">Why not <a href="register.php" style="text-decoration: none;">register</a> an account?</span>
                                    </div>
                                </div>
                            </div>
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