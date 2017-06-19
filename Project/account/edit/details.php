<?php
    require '../../includes/db.php';
    session_start();
    
    $active_page = "profile";
    
    // Escape string to protect against SQL Injection
    $username = $mysqli->escape_string($_POST['username']);
    $password1 = $mysqli->escape_string($_POST['password1']);
    $password2 = $mysqli->escape_string(password_hash($_POST['password1'], PASSWORD_BCRYPT));
    
    // Get session variable for ID of current user
    $result = $mysqli->query("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
    $user = $result->fetch_assoc();
    $_SESSION['id'] = $user['id'];
    
    // Change details
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['update'])){
            // Query to check if username exists
            $query = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
            
            if($username == $_SESSION['username'] || $password2 == $_SESSION['password']){ // Check if username or password aren't changed
                // Allow update even if they are the same
                $update = $mysqli->query("UPDATE users SET username = '$username', password = '$password2' WHERE id ='" . $_SESSION['id'] . "'");
                
                $_SESSION['username'] = $username;
                // Unhashed password for password input field
                $_SESSION['password'] = $password1;
                $_SESSION['message'] = "Details updated";
                
                // Redirect to profile page
                header('location: ../profile.php');
                exit;
            }else if($query->num_rows > 0){ // Check if new username is already in use
                // Do not update
                $_SESSION['message'] = "Username taken";
            
            }else{ // Update details
                $update = $mysqli->query("UPDATE users SET username = '$username', password = '$password2' WHERE id ='" . $_SESSION['id'] . "'");
                
                // Update session variables to new details
                $_SESSION['username'] = $username;
                // Unhashed password for password input field
                $_SESSION['password'] = $password1;
                $_SESSION['message'] = "Details updated";
                
                // Redirect to profile page
                header('location: ../profile.php');
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Edit | Details</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="../../css/output.css"/>
    </head>
    <body>
        <?php if ($_SESSION['loggedin'] === true){ // Show edit page
            ?>
            <div class="vertical-lg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include '../../includes/navigation.php' ?>
                    </div>
                    
                    <div class="col-md-9">
                        <span class="font-grey_light font-header"><a href="/Project/account/profile.php" class="font-grey_light">Profile</a> | Edit | <a href="/Project/account/edit/details.php" class="font-grey_light">Details</a></span>
                        <h3 class="font-white font-subheader">Edit Details</h3>
                        
                        <div class="vertical-lg"></div>
                    
                        <!-- Account Information -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="avatar" style="opacity: 0.5;">
                                        <span class="fa fa-user"></span>
                                    </div>
                                    
                                    <div class="vertical-sm"></div>
                                    
                                    <div class="details">
                                        <form method="post" autocomplete="off">
                                            <!-- Username -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-xs-2">
                                                        <label class="font-white" for="username">Username:</label>
                                                        <input type="text" class="form-control" name="username" value ="<?php echo $_SESSION['username']; ?>" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Password -->
                                            <div class="container">
                                                <div class="form-group row">
                                                    <div class="col-xs-2">
                                                        <label class="font-white" for="password1">Password:</label>
                                                        <input type="password" class="form-control" name="password1" value ="<?php echo $_SESSION['password']; ?>" autocomplete="off" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
                                        </form>   
                                    </div>
                                </div>
                                <div class="col-md-8" style="opacity: 0.5;">
                                    <h5 class="font-white font-subheader">Submissions.</h5>
                                    <div class="content-blackbox">
                                        <h2 class="font-blue font-content text-center">No Submissions.</h2>
                                    </div>
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
        <?php } else{ // Redirect to home page
            header('location: ../../index.php');
            exit;
        }?>
    </body>
</html>