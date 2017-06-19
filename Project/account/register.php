<?php 
    require '../includes/db.php';
    session_start();
    
    $active_page = "register";
    
    // Register
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        if (isset($_POST['register'])){
            
            // Session variables
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['username'] = $_POST['username'];
            
            // Escape $_POST variables to protect against SQL Injection
            $email = $mysqli->escape_string($_POST['email']);
            $username = $mysqli->escape_string($_POST['username']);
            $password = $mysqli->escape_string(password_hash($_POST['password1'], PASSWORD_BCRYPT));
            
            // Check that passwords match
            if ($_POST['password1'] == $_POST['password2']){
                
                // Check if user already exists (email & username)
                $result = $mysqli->query("SELECT * FROM users WHERE email = '$email' OR username = '$username'");
                
                // User already exists
                if ($result->num_rows > 0) {
                    $_SESSION['message'] = "A user with that email/username <b>already exists</b>";
                }else { // Continue registration
                    $sql = "INSERT INTO users (email, username, password) "
                    . "VALUES ('$email', '$username', '$password')";
                    
                    // Register user
                    if ($mysqli->query($sql)) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['message'] = "Account <b>registered</b>.";
                        header('location: ../index.php');
                        exit;
                    }else { // Could not register user
                        $_SESSION['message'] = "Could <b>not register user</b>";  
                    }
                }  
            }else { // Passwords do not match
                $_SESSION['message'] = "The passwords <b>do not match</b>";
            }
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Register</title>
        
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
            if ($_SESSION['loggedin'] === true) {
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
                            <span class="font-grey_light font-header">REGISTER</span>
                            <h3 class="font-white font-subheader">Create an Account</h3>
                            
                            <div class="vertical-sm"></div>
                            
                            <!-- Registration form -->
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
                                            
                                            <!-- Username -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-xs-2">
                                                        <label class="font-white" for="username">Username:</label>
                                                        <input type="text" class="form-control" name="username" autocomplete="off" required />
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
                                            
                                            <!-- Confirm password -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-xs-2">
                                                        <label class="font-white" for="password2">Confirm password:</label>
                                                        <input type="password" class="form-control" name="password2" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" name="register" value="Register"/>
                                        </form>
                                    </div>
                                    
                                    <!-- Login link -->
                                    <div class="col-md-6">
                                        <h3 class="font-white">Already a Member?</h3>
                                        <span class="font-white">Go ahead and <a href="login.php" style="text-decoration: none;">login</a> to your account!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    // Alert if registration fails
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
            <?php } ?>
        ?>
    </body>
</html>