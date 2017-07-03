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
            
            // Protect against SQL Injection
            $email = $mysqli->escape_string($_POST['email']);
            $username = $mysqli->escape_string($_POST['username']);
            $password1 = $mysqli->escape_string($_POST['password1']);
            $password2 = $mysqli->escape_string(password_hash($_POST['password1'], PASSWORD_BCRYPT));
            $userid = uniqid();
            $admin_rights = 0;
            
            // Check that passwords match
            if ($_POST['password1'] == $_POST['password2']){
                
                // Check if user already exists (email & username)
                $result = $mysqli->query("SELECT * FROM users WHERE email = '$email' OR username = '$username'");
                
                // User already exists
                if ($result->num_rows > 0) {
                    $_SESSION['message-type'] = "error-message";
                    $_SESSION['message'] = "Username/Email taken";
                }else { // Continue registration
                    $sql = "INSERT INTO users (email, username, password, userid, admin_rights)
                    VALUES ('$email', '$username', '$password2', '$userid', '$admin_rights')";
                    
                    // Register user
                    if ($mysqli->query($sql)) {
                        $_SESSION['loggedin'] = true;
                        
                        //Unhashed password (for details.php)
                        $_SESSION['password'] = $password1;
                        
                        // User ID
                        $_SESSION['userid'] = $userid;
                        
                        // Success message
                        $_SESSION['message-type'] = "success-message";
                        $_SESSION['message'] = "Account registered.";
                        
                        header('location: ../index.php');
                        exit;
                    }else { // Could not register user
                        $_SESSION['message-type'] = "error-message";
                        $_SESSION['message'] = "Could not register user";  
                    }
                }  
            }else { // Passwords do not match
                $_SESSION['message-type'] = "error-message";
                $_SESSION['message'] = "The passwords do not match";
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="content-nav col-md-1">
                            <?php include '../includes/content-nav.php'?>
                        </div>

                        <div class="col-md-10 offset-md-1">
                            <!-- Registration form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="vertical-md"></div>
                                        <h1 class="font-white text-center"><i class="fa fa-user-plus"></i></h1>
                                        <h2 class="font-white font-content text-center">Create an account</h2>
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
                                                
                                                <!-- Username -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="username">Username:</label>
                                                            <input type="text" class="form-control" name="username" autocomplete="off" required />
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
                                                
                                                <!-- Confirm password -->
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label class="font-white" for="password2">Confirm password:</label>
                                                            <input type="password" class="form-control" name="password2" autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Register button -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary" name="register" value="Register"/>
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
                                                        <span class="font-white font-content">Have an account? <a href="/Project/account/login.php">Sign in</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="account-nav col-md-1">
                            <?php include '../includes/account-nav.php'; ?>
                        </div>
                    </div>
                </div>
                <?php
                    // Alert if registration fails
                    if (isset($_SESSION['message'])){?>
                        <div class="<?php echo $_SESSION['message-type']; ?>">
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